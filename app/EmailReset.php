<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Notifications\Notifiable;
use App\Notifications\ResetEmail;
use Carbon\Carbon;

class EmailReset extends Model
{

	use Notifiable;

	protected $fillable = [
		'user_id', 'new_email', 'token',
	];

	public function updateOrSendEmailResetLink($request)
	{
		$user = (new User)->find($request->input('id'));
		if ($user) {
			if ($user->id == Auth::id()) {
				$current_pass = $request->input('current_password');
				if (Hash::check($current_pass, $user->password)) {
					$current_email = $request->input('email');
					if ($request->input('password') == null && $user->email == $current_email) {
						$user->name = $request->input('name');
						$user->email = $request->input('email');
						$user->save();
						$request->session()->flash('success_message', 'ユーザー情報を更新しました');
						return;
					} elseif ($request->input('password') == null && $user->email !== $current_email) {
						$user->name = $request->input('name');
						$user->save();
						$this->sendEmail($request, $current_email);
					} elseif ($request->input('password') && $user->email == $current_email) {
						$user->name = $request->input('name');
						$user->email = $request->input('email');
						$user->password = Hash::make($request->input('password'));
						$user->save();
						$request->session()->flash('success_message', 'ユーザー情報を更新しました');
						return;
					} else {
						$user->name = $request->input('name');
						$user->password = Hash::make($request->input('password'));
						$user->save();
						$this->sendEmail($request, $current_email);
					}
				} else {
					$request->session()->flash('message', '現在のパスワードが間違っています');
					return;
				}
			}
		}
		$request->session()->flash('message', 'このユーザー情報は変更できません');
		return;
	}

	public function sendEmail($request, $current_email)
	{
		$new_email = $current_email;
		$token = hash_hmac(
			'sha256',
			str_random(40) . $new_email,
			config('app.key')
		);
		//同じメールアドレスがないか探す。あった場合、トークンとuser_idを上書き
		$result = $this->where('email',  $new_email)->first();
		if ($result) {
			$result->user_id = Auth::id();
			$result->token = $token;
			$result->save();
			//$resultに入っているemailカラムに対してメール送信が行われる。
			$result->notify(new ResetEmail($token));
		} else {
			$insert = new EmailReset;
			$insert->user_id = Auth::id();
			$insert->email = $new_email;
			$insert->token = $token;
			$insert->save();
			//$insertに入っているemailカラムに対してメール送信が行われる。
			$insert->notify(new ResetEmail($token));
		}
		$request->session()->flash('success_message', '確認メールを送信しました。');
		return;
	}

	public function change($request, $token)
	{
		//まずトークンが合っているか確認。合っていれば、ログインした人がメール変えようととしている人と一緒か、トークンの有効期限が切れてないかで条件分岐
		$email_resets = $this->where('token', $token)->first();
		if ($email_resets) {
			$user_id = $email_resets->user_id;
			if ($user_id == Auth::id() && !$this->tokenExpired($email_resets->created_at)) {
				//ログイン者とメール変えようとしてる人が一致、かつトークンが有効期限内
				$user = (new User)->find($email_resets->user_id);
				$user->email = $email_resets->email;
				$user->save();
				$email_resets->delete();
				$request->session()->flash('success_message', 'メールアドレスを変更しました');
				return;
			} elseif ($user_id == Auth::id() && $this->tokenExpired($email_resets->created_at)) {
				$email_resets->delete();
				$request->session()->flash('message', 'メールアドレス更新の有効期限が切れました。再度お試しください。');
				return;
			} elseif ($user_id !== Auth::id() && !$this->tokenExpired($email_resets->created_at)) {
				$request->session()->flash('message', 'このメールアドレスには更新できません。再度お試しください。');
				return;
			} else {
				$email_resets->delete();
			}
		}
		$request->session()->flash('message', '不正なアクセスです。再度お試しください。');
		return;
	}

	protected function tokenExpired($createdAt)
	{
		//時間は秒単位->30分に設定
		$expires = 1800;
		return Carbon::parse($createdAt)->addSeconds($expires)->isPast();
	}

}
