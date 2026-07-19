<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    // commentsテーブルを作成
    public function up(): void
    {
        Schema::create('comments', function (Blueprint $table) {
            $table->id();

            // コメントしたユーザーID
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();

            // コメントされた商品ID
            $table->foreignId('item_id')->constrained()->cascadeOnDelete();

            // コメント本文
            $table->string('comment', 255);

            $table->timestamps();
        });
    }

    // commentsテーブルを削除
    public function down(): void
    {
        Schema::dropIfExists('comments');
    }
};
