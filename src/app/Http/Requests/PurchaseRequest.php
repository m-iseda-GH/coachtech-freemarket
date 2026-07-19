<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PurchaseRequest extends FormRequest
{
    //リクエストを許可
    public function authorize(): bool
    {
        return true;
    }

    //支払い方法の入力ルールを設定
    public function rules(): array
    {
        //コンビニ支払いもしくはカード支払い
        return [
            'payment_method' => ['required', 'in:convenience,card'],
        ];
    }

    //バリデーションエラーメッセージを設定
    public function messages(): array
    {
        return [
            'payment_method.required' => '支払い方法を選択してください',
            'payment_method.in' => '支払い方法を正しく選択してください',
        ];
    }

    //エラーメッセージで表示する項目を設定
    public function attributes(): array
    {
        return [
            'payment_method' => '支払い方法',
        ];
    }
}
