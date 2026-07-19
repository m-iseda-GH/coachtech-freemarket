<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SellRequest extends FormRequest
{
    // 商品出品を許可
    public function authorize(): bool
    {
        return true;
    }

    // 商品出品時のバリデーションルール
    public function rules(): array
    {
        return [
            'image' => ['required', 'image', 'mimes:jpeg,png'],
            'category_ids' => ['required', 'array', 'min:1'],
            'category_ids.*' => ['exists:categories,id'],
            'condition_id' => ['required', 'exists:conditions,id'],
            'name' => ['required', 'string', 'max:255'],
            'brand_name' => ['nullable', 'string', 'max:255'],
            'description' => ['required', 'string', 'max:1000'],
            'price' => ['required', 'integer', 'min:1'],
        ];
    }

    // 独自のエラーメッセージ
    public function messages(): array
    {
        return [
            'image.required' => '商品画像を選択してください',
            'image.image' => '商品画像は画像ファイルを選択してください',
            'image.mimes' => '商品画像はjpegまたはpng形式で選択してください',
            'category_ids.required' => 'カテゴリーを選択してください',
            'category_ids.min' => 'カテゴリーを選択してください',
            'condition_id.required' => '商品の状態を選択してください',
            'name.required' => '商品名を入力してください',
            'description.required' => '商品の説明を入力してください',
            'price.required' => '販売価格を入力してください',
            'price.integer' => '販売価格は整数で入力してください',
            'price.min' => '販売価格は1円以上で入力してください',
        ];
    }

    // バリデーションエラー時の項目名
    public function attributes(): array
    {
        return [
            'image' => '商品画像',
            'category_ids' => 'カテゴリー',
            'condition_id' => '商品の状態',
            'name' => '商品名',
            'brand_name' => 'ブランド名',
            'description' => '商品の説明',
            'price' => '販売価格',
        ];
    }
}
