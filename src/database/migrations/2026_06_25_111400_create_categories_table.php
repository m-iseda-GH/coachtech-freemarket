<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    // categoriesテーブルを作成
    public function up(): void
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique(); // カテゴリー名
            $table->timestamps();
        });
    }

    // categoriesテーブルを削除
    public function down(): void
    {
        Schema::dropIfExists('categories');
    }
};
