<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Condition;
use App\Models\Item;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class ItemSeeder extends Seeder
{
    // 商品の初期データを登録
    public function run(): void
    {
        // 商品を出品するテストユーザーを作成
        $user = User::firstOrCreate(
            ['email' => 'seller@example.com'],
            [
                'name' => 'seller',
                'password' => Hash::make('password123'),
                'postal_code' => '123-4567',
                'address' => '東京都渋谷区',
                'building' => 'テストビル101',
            ]
        );

        // 商品の初期データ
        $items = [
            [
                'name' => '腕時計',
                'brand_name' => 'Rolax',
                'description' => 'スタイリッシュなデザインのメンズ腕時計',
                'price' => 15000,
                'condition' => '良好',
                'image' => 'https://coachtech-matter.s3.ap-northeast-1.amazonaws.com/image/Armani+Mens+Clock.jpg',
                'categories' => ['ファッション', 'メンズ', 'アクセサリー'],
            ],
            [
                'name' => 'HDD',
                'brand_name' => '西芝',
                'description' => '高速で信頼性の高いハードディスク',
                'price' => 5000,
                'condition' => '目立った傷や汚れなし',
                'image' => 'https://coachtech-matter.s3.ap-northeast-1.amazonaws.com/image/HDD+Hard+Disk.jpg',
                'categories' => ['家電'],
            ],
            [
                'name' => '玉ねぎ3束',
                'brand_name' => null,
                'description' => '新鮮な玉ねぎ3束のセット',
                'price' => 300,
                'condition' => 'やや傷や汚れあり',
                'image' => 'https://coachtech-matter.s3.ap-northeast-1.amazonaws.com/image/iLoveIMG+d.jpg',
                'categories' => ['キッチン'],
            ],
            [
                'name' => '革靴',
                'brand_name' => null,
                'description' => 'クラシックデザインの革靴',
                'price' => 4000,
                'condition' => '状態が悪い',
                'image' => 'https://coachtech-matter.s3.ap-northeast-1.amazonaws.com/image/Leather+Shoes+Product+Photo.jpg',
                'categories' => ['ファッション', 'メンズ'],
            ],
            [
                'name' => 'ノートPC',
                'brand_name' => null,
                'description' => '高性能なノートパソコン',
                'price' => 45000,
                'condition' => '良好',
                'image' => 'https://coachtech-matter.s3.ap-northeast-1.amazonaws.com/image/Living+Room+Laptop.jpg',
                'categories' => ['家電'],
            ],
            [
                'name' => 'マイク',
                'brand_name' => null,
                'description' => '高音質のレコーディングマイク',
                'price' => 8000,
                'condition' => '目立った傷や汚れなし',
                'image' => 'https://coachtech-matter.s3.ap-northeast-1.amazonaws.com/image/Music+Mic+4632231.jpg',
                'categories' => ['家電'],
            ],
            [
                'name' => 'ショルダーバッグ',
                'brand_name' => null,
                'description' => 'おしゃれなショルダーバッグ',
                'price' => 3500,
                'condition' => 'やや傷や汚れあり',
                'image' => 'https://coachtech-matter.s3.ap-northeast-1.amazonaws.com/image/Purse+fashion+pocket.jpg',
                'categories' => ['ファッション', 'レディース'],
            ],
            [
                'name' => 'タンブラー',
                'brand_name' => null,
                'description' => '使いやすいタンブラー',
                'price' => 500,
                'condition' => '状態が悪い',
                'image' => 'https://coachtech-matter.s3.ap-northeast-1.amazonaws.com/image/Tumbler+souvenir.jpg',
                'categories' => ['キッチン'],
            ],
            [
                'name' => 'コーヒーミル',
                'brand_name' => 'Starbacks',
                'description' => '手動のコーヒーミル',
                'price' => 4000,
                'condition' => '良好',
                'image' => 'https://coachtech-matter.s3.ap-northeast-1.amazonaws.com/image/Waitress+with+Coffee+Grinder.jpg',
                'categories' => ['キッチン'],
            ],
            [
                'name' => 'メイクセット',
                'brand_name' => null,
                'description' => '便利なメイクアップセット',
                'price' => 2500,
                'condition' => '目立った傷や汚れなし',
                'image' => 'https://coachtech-matter.s3.ap-northeast-1.amazonaws.com/image/%E5%A4%96%E5%87%BA%E3%83%A1%E3%82%A4%E3%82%AF%E3%82%A2%E3%83%83%E3%83%95%E3%82%9A%E3%82%BB%E3%83%83%E3%83%88.jpg',
                'categories' => ['コスメ', 'レディース'],
            ],
        ];

        foreach ($items as $itemData) {
            // 商品状態を取得
            $condition = Condition::where('name', $itemData['condition'])->first();

            // 商品を登録
            $item = Item::firstOrCreate(
                ['name' => $itemData['name']],
                [
                    'user_id' => $user->id,
                    'condition_id' => $condition->id,
                    'brand_name' => $itemData['brand_name'],
                    'description' => $itemData['description'],
                    'price' => $itemData['price'],
                    'image' => $itemData['image'],
                    'is_sold' => false,
                ]
            );

            // カテゴリーIDを取得
            $categoryIds = Category::whereIn('name', $itemData['categories'])
                ->pluck('id')
                ->toArray();

            // 商品とカテゴリーを紐づけ
            $item->categories()->syncWithoutDetaching($categoryIds);
        }
    }
}
