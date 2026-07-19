<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProfileRequest extends FormRequest
{
    // プロフィール更新を許可
    public function authorize(): bool
    {
        return true;
    }

    // プロフィール更新時のバリデーションルール
    public function rules(): array
    {
        return [
            'profile_image' => ['nullable', 'image', 'mimes:jpeg,png'],
            'remove_profile_image' => ['nullable', 'boolean'],
            'name' => ['required', 'string', 'max:20'],
            'postal_code' => ['required', 'string', 'regex:/^\d{3}-\d{4}$/'],
            'address' => ['required', 'string', 'max:255'],
            'building' => ['nullable', 'string', 'max:255'],
        ];
    }

    // 独自のエラーメッセージ
    public function messages(): array
    {
        return [
            'postal_code.regex' => '郵便番号はハイフンありの8文字で入力してください',
        ];
    }

    // バリデーションエラー時の項目名
    public function attributes(): array
    {
        return [
            'profile_image' => 'プロフィール画像',
            'remove_profile_image' => 'プロフィール画像削除',
            'name' => 'ユーザー名',
            'postal_code' => '郵便番号',
            'address' => '住所',
            'building' => '建物名',
        ];
    }
}
