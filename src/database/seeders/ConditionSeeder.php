<?php

namespace Database\Seeders;

use App\Models\Condition;
use Illuminate\Database\Seeder;

class ConditionSeeder extends Seeder
{
    public function run(): void
    {
        //商品情報の初期データ
        $conditions = [
            '良好',
            '目立った傷や汚れなし',
            'やや傷や汚れあり',
            '状態が悪い',
        ];

        //初期データを登録(※既に存在する場合は登録しない)
        foreach ($conditions as $condition) {
            Condition::firstOrCreate([
                'name' => $condition,
            ]);
        }
    }
}
