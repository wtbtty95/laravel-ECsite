<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ItemUpdateRequest extends FormRequest
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
			'name' => 'required|max:80',
			'description' => 'required|max:255',
			'inventory' => 'required|integer|between:0,4294967295',
			'image' => 'bail|nullable|file|image|mimes:jpeg,jpg,png'
        ];
	}

	public function attributes()
	{
		return [
			'name' => '商品名',
			'description' => '商品説明',
			'inventory' => '在庫数',
		];
	}

	public function messages()
	{
		return [
			'required' => ':attributeは必須です',
			'name.max' => '商品名は80文字以内にしてください',
			'description.max' => '商品説明は255文字以内にしてください',
			'inventory.integer' => '在庫数は整数にしてください',
			'inventory.between' => '在庫数は0〜4294967295までにしてください',
			'image.file' => 'アップロードできないファイルです',
			'image.image' => '選択されたファイルが画像ではありません',
			'image.mimes' => '拡張子が「jpeg」「jpg」「png」の画像のみアップロードできます',
		];
	}


}
