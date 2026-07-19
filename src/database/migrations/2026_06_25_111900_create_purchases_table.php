<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    // purchasesテーブルを作成
    public function up(): void
    {
        Schema::create('purchases', function (Blueprint $table) {
            $table->id();

            // 購入したユーザーID
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();

            // 購入された商品ID
            $table->foreignId('item_id')->unique()->constrained()->cascadeOnDelete();

            // 支払い方法
            $table->string('payment_method');

            // 配送先住所
            $table->string('postal_code');
            $table->string('address');
            $table->string('building')->nullable();

            $table->timestamps();
        });
    }

    // purchasesテーブルを削除
    public function down(): void
    {
        Schema::dropIfExists('purchases');
    }
};
