<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable;

    // 一括代入を許可するカラム
    protected $fillable = [
        'name',
        'email',
        'password',
        'profile_image',
        'postal_code',
        'address',
        'building',
    ];

    // 配列変換時に非表示にするカラム
    protected $hidden = [
        'password',
        'remember_token',
    ];

    // 型変換を行うカラム
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    // ユーザーが出品した商品
    public function items()
    {
        return $this->hasMany(Item::class);
    }

    // ユーザーが付けたいいね
    public function likes()
    {
        return $this->hasMany(Like::class);
    }

    // ユーザーが投稿したコメント
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    // ユーザーの購入履歴
    public function purchases()
    {
        return $this->hasMany(Purchase::class);
    }

    // ユーザーがいいねした商品
    public function likedItems()
    {
        return $this->belongsToMany(Item::class, 'likes')->withTimestamps();
    }
}
