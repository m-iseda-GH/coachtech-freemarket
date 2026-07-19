<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CommentRequest extends FormRequest
{
    //リクエストを利用できるか判定(常に利用可能)
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        //コメント欄のバリデーションルール設定
        return [
            'comment' => ['required', 'string', 'max:255'],
        ];
    }

    //表示されるエラーメッセージの項目名
    public function attributes(): array
    {
        return [
            'comment' => 'コメント',
        ];
    }
}
