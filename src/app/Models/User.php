<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    //一括代入を許可するカラム
    protected $fillable = [
        'name',
        'email',
        'password',
        'profile_image',
        'postal_code',
        'address',
        'building',
    ];

    //ユーザーが出品した商品一覧を取得
    public function items()
    {
        return $this->hasMany(Item::class);
    }
    //ユーザーが購入した商品一覧を取得
    public function purchases()
    {
        return $this->hasMany(Purchase::class);
    }
    //ユーザーは複数のいいね情報を所持
    public function likes()
    {
        return $this->hasMany(Like::class);
    }
    //ユーザーがいいねした商品一覧を取得(created_atやupdated_atも併せて自動更新)
    public function likedItems()
    {
        return $this->belongsToMany(Item::class, 'likes')->withTimestamps();
    }
    //ユーザーが投稿したコメント一覧を取得
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
    //JSON変換時に非表示
    protected $hidden = [
        'password',
        'remember_token',
    ];
    //自動で型を変換
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];
}
