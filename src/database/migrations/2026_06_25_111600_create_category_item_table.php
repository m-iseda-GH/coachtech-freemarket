<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    // category_itemテーブルを作成
    public function up(): void
    {
        Schema::create('category_item', function (Blueprint $table) {
            $table->id();

            // 商品ID
            $table->foreignId('item_id')->constrained()->cascadeOnDelete();

            // カテゴリーID
            $table->foreignId('category_id')->constrained()->cascadeOnDelete();

            $table->timestamps();
        });
    }

    // category_itemテーブルを削除
    public function down(): void
    {
        Schema::dropIfExists('category_item');
    }
};
