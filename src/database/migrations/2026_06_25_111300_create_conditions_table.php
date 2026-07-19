<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    // conditionsテーブルを作成
    public function up(): void
    {
        Schema::create('conditions', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique(); // 商品状態名
            $table->timestamps();
        });
    }

    // conditionsテーブルを削除
    public function down(): void
    {
        Schema::dropIfExists('conditions');
    }
};
