<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PurchaseAddressRequest extends FormRequest
{
    //このリクエストの仕様を許可
    public function authorize(): bool
    {
        return true;
    }

    //配送先住所の入力ルール
    public function rules(): array
    {
        return [
            //郵便番号は必須(文字列として扱う)
            'postal_code' => ['required', 'string', 'regex:/^\d{3}-\d{4}$/'],
            'address' => ['required', 'string', 'max:255'],
            'building' => ['nullable', 'string', 'max:255'],
        ];
    }

    //バリデーションエラーメッセージの設定
    public function messages(): array
    {
        return [
            'postal_code.required' => '郵便番号を入力してください',
            'postal_code.regex' => '郵便番号はハイフンありの8文字で入力してください',
            'address.required' => '住所を入力してください',
            'address.max' => '住所は255文字以内で入力してください',
            'building.max' => '建物名は255文字以内で入力してください',
        ];
    }

    //エラーメッセージで表示する項目の設定
    public function attributes(): array
    {
        return [
            'postal_code' => '郵便番号',
            'address' => '住所',
            'building' => '建物名',
        ];
    }
}
