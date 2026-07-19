<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory;

    // 一括代入を許可するカラム
    protected $fillable = [
        'user_id',
        'condition_id',
        'name',
        'brand_name',
        'description',
        'price',
        'image',
        'is_sold',
    ];

    // 商品の出品者
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // 商品の状態
    public function condition()
    {
        return $this->belongsTo(Condition::class);
    }

    // 商品に紐づくカテゴリー
    public function categories()
    {
        return $this->belongsToMany(Category::class, 'category_item')
            ->withTimestamps();
    }

    // 商品に付いたいいね
    public function likes()
    {
        return $this->hasMany(Like::class);
    }

    // 商品に投稿されたコメント
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    // 商品の購入情報
    public function purchase()
    {
        return $this->hasOne(Purchase::class);
    }

    // この商品をいいねしたユーザー
    public function likedUsers()
    {
        return $this->belongsToMany(User::class, 'likes')
            ->withTimestamps();
    }
}
