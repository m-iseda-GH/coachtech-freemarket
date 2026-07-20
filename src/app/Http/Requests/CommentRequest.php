<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CommentRequest extends FormRequest
{
    // コメント投稿を許可
    public function authorize(): bool
    {
        return true;
    }

    // コメント投稿時のバリデーションルール
    public function rules(): array
    {
        return [
            'comment' => ['required', 'string', 'max:255'],
        ];
    }

    // バリデーションエラーメッセージ
    public function messages(): array
    {
        return [
            'comment.required' => 'コメントを入力してください',
            'comment.max' => 'コメントは255文字以内で入力してください',
        ];
    }

    // バリデーションエラー時の項目名
    public function attributes(): array
    {
        return [
            'comment' => 'コメント',
        ];
    }
}
