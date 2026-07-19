<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    // likesテーブルを作成
    public function up(): void
    {
        Schema::create('likes', function (Blueprint $table) {
            $table->id();

            // いいねしたユーザーID
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();

            // いいねされた商品ID
            $table->foreignId('item_id')->constrained()->cascadeOnDelete();

            $table->timestamps();

            // 同じユーザーが同じ商品に複数回いいねできないようにする
            $table->unique(['user_id', 'item_id']);
        });
    }

    // likesテーブルを削除
    public function down(): void
    {
        Schema::dropIfExists('likes');
    }
};
