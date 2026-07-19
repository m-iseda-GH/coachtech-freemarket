<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SellRequest extends FormRequest
{
    // このリクエストの使用を許可
    public function authorize(): bool
    {
        return true;
    }

    // 商品出品フォームの入力ルールを設定
    public function rules(): array
    {
        return [
            // 商品画像は必須・画像形式・ipegまたはpng
            'image' => ['required', 'image', 'mimes:jpeg,png'],

            // カテゴリーは1つ以上選択
            'category_ids' => ['required', 'array', 'min:1'],

            // 選択されたカテゴリーIDがcategoriesテーブルに存在するか確認
            'category_ids.*' => ['exists:categories,id'],

            // 商品状態IDがcongitionsテーブルに存在するか確認
            'condition_id' => ['required', 'exists:conditions,id'],

            // 商品名は必須・文字列・255文字以内
            'name' => ['required', 'string', 'max:255'],

            // ブランド名は任意・文字列・255文字以内
            'brand_name' => ['nullable', 'string', 'max:255'],

            //　商品説明は必須・文字列・1000文字以内
            'description' => ['required', 'string', 'max:1000'],

            // 販売価格は必須・整数・1円以上
            'price' => ['required', 'integer', 'min:1'],
        ];
    }

    // バリデーションエラーメッセージを設定
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

    // エラーメッセージで表示する項目名を設定
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
