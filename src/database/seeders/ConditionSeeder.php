<?php

namespace Database\Seeders;

use App\Models\Condition;
use Illuminate\Database\Seeder;

class ConditionSeeder extends Seeder
{
    // 商品状態の初期データを登録
    public function run(): void
    {
        $conditions = [
            '良好',
            '目立った傷や汚れなし',
            'やや傷や汚れあり',
            '状態が悪い',
        ];

        foreach ($conditions as $condition) {
            // 同じ状態名がなければ登録
            Condition::firstOrCreate([
                'name' => $condition,
            ]);
        }
    }
}
