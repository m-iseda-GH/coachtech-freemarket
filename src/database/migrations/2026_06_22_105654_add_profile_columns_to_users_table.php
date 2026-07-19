<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    // usersテーブルにプロフィール項目を追加
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('profile_image')->nullable()->after('password');
            $table->string('postal_code')->nullable()->after('profile_image');
            $table->string('address')->nullable()->after('postal_code');
            $table->string('building')->nullable()->after('address');
        });
    }

    // 追加したプロフィール項目を削除
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn([
                'profile_image',
                'postal_code',
                'address',
                'building',
            ]);
        });
    }
};
