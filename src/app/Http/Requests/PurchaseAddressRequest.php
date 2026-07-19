<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PurchaseAddressRequest extends FormRequest
{
    // 配送先住所の変更を許可
    public function authorize(): bool
    {
        return true;
    }

    // 配送先住所変更時のバリデーションルール
    public function rules(): array
    {
        return [
            'postal_code' => ['required', 'string', 'regex:/^\d{3}-\d{4}$/'],
            'address' => ['required', 'string', 'max:255'],
            'building' => ['nullable', 'string', 'max:255'],
        ];
    }

    // 独自のエラーメッセージ
    public function messages(): array
    {
        return [
            'postal_code.required' => '郵便番号を入力してください',
            'postal_code.regex' => '郵便番号はハイフンありの8文字で入力してください',
            'address.required' => '住所を入力してください',
        ];
    }

    // バリデーションエラー時の項目名
    public function attributes(): array
    {
        return [
            'postal_code' => '郵便番号',
            'address' => '住所',
            'building' => '建物名',
        ];
    }
}
