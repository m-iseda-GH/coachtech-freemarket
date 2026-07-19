<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{

    public function run(): void
    {
        //作成したSeederを上から順(状態-->カテゴリ-->商品登録)に実行
        $this->call([
            ConditionSeeder::class,
            CategorySeeder::class,
            ItemSeeder::class,
        ]);
    }
}
