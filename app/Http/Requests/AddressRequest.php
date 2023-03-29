<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
class AddressRequest extends FormRequest
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
			'name' => 'required|max:40',
			'postcode' => 'required|digits:7',
			'prefectures' => 'required|max:3',
			'city' => 'required|between:2,10',
			'address_detail' => [
				'required',
				Rule::unique('addresses')->ignore($this->id, 'id')->where(function ($query) {
					return $query->where('user_id', Auth::id())->where('deleted_at', NULL);
				}),
			],
			'tel' => [
				'required',
				'digits_between:10,11',
				'regex:^0[0-9]{9,10}$^',
			],
		];
	}

	public function attributes()
	{
		return [
			'name' => '氏名',
			'postcode' => '郵便番号',
			'prefectures' => '都道府県',
			'city' => '市区町村',
			'address_detail' => '町名、番地、建物名、部屋番号等',
			'tel' => '電話番号',
		];
	}

	public function messages()
	{
		return [
			'required' => ':attributeは必須です',
			'name.max' => '氏名は40文字以内で入力してください',
			'postcode.digits' => '郵便番号はハイフン抜きの半角数字7桁で入力してください',
			'prefectures.max' => '都道府県は3文字以内で入力してください',
			'city.between' => '市区町村は2~10文字で入力してください',
			'address_detail.max' => ':attributeは100文字以内で入力してください',
			'address_detail.unique' => 'あなたが既に登録した住所と同じ住所を登録することはできません',
			'tel.digits_between' => '電話番号はハイフン抜きの半角数字10~11桁で入力してください',
			'tel.regex' => '電話番号を正しく入力してください',
		];
	}

}
