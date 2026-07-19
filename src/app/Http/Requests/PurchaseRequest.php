<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PurchaseRequest extends FormRequest
{
    // 商品購入を許可
    public function authorize(): bool
    {
        return true;
    }

    // 商品購入時のバリデーションルール
    public function rules(): array
    {
        return [
            'payment_method' => ['required', 'in:convenience,card'],
        ];
    }

    // 独自のエラーメッセージ
    public function messages(): array
    {
        return [
            'payment_method.required' => '支払い方法を選択してください',
            'payment_method.in' => '支払い方法を正しく選択してください',
        ];
    }

    // バリデーションエラー時の項目名
    public function attributes(): array
    {
        return [
            'payment_method' => '支払い方法',
        ];
    }
}
