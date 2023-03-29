<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\EmailReset;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\UserRequest;

class EmailResetController extends Controller
{

	public function __construct(EmailReset $email_reset)
	{
		$this->emailReset = $email_reset;
	}

	public function edit()
	{
		$user = Auth::user();
		return view('user.edit', compact('user'));
	}

	public function update(UserRequest $request)
	{
		$this->emailReset->updateOrSendEmailResetLink($request);
		return redirect('/user/edit');
	}

	public function reset(Request $request, $token)
	{
		$this->emailReset->change($request, $token);
		return redirect('/user/edit');
	}

}
