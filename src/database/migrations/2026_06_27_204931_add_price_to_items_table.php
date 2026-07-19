<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    //※migrate実行時に呼ばれる(テーブル・カラム追加・変更)
    public function up(): void
    {
        //商品価格カラムを追加
        Schema::table('items', function (Blueprint $table) {
            //説明の後に価格(カラム)を配置
            $table->unsignedInteger('price')->after('description');
        });
    }

    //※rollback実行時に呼ばれる(up()で行った処理をもとに戻す)
    public function down(): void
    {
        //商品価格カラムを削除
        Schema::table('items', function (Blueprint $table) {
            $table->dropColumn('price');
        });
    }
};
