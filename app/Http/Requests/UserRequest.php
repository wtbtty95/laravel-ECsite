<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
 use Illuminate\Validation\Rule;

class UserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
	 */

    public function rules()
    {
		return [
			'name' => 'required|max:255',
			'email' => [
				'required',
				'max:255',
				'email',
				Rule::unique('users')->ignore($this->id, 'id'),
			],
			'password' => 'bail|nullable|between:6,255|confirmed',
			'password_confirmation' => 'required_with:password',
			'current_password' => 'required|between:6,255',
        ];
	}

	public function attributes()
	{
		return [
			'name' => '名前',
			'email' => 'メールアドレス',
			'password' => '新しいパスワード',
			'password_confirmation' => '新しいパスワード（確認用）',
			'current_password' => '現在のパスワード',
		];
	}

	public function messages()
	{
		return [
			'required' => ':attributeは必須です',
			'max' => ':attributeは255文字以内で入力してください',
			'email.unique' => 'このメールアドレスは使用できません',
			'email.email' => 'メールアドレスを正しい形式で入力してください',
			'password.between' => '新しいパスワードは6~255文字で入力してください',
			'confirmed' => '新しいパスワードは確認用と一致させてください',
			'required_with' => '新しいパスワード（確認用）を入力してください',
			'current_password.between' => '現在のパスワードは6~255文字で入力してください',
		];
	}

}
