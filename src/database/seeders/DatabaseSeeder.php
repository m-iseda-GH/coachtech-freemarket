<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    // 各Seederを実行
    public function run(): void
    {
        $this->call([
            ConditionSeeder::class,
            CategorySeeder::class,
            ItemSeeder::class,
        ]);
    }
}
