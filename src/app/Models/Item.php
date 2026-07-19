<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory;

    //一括代入を許可するカラム
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

    //商品出品者を取得
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    //商品状態を取得
    public function condition()
    {
        return $this->belongsTo(Condition::class);
    }

    //※商品に紐づくカテゴリ一覧を取得
    public function categories()
    {
        return $this->belongsToMany(Category::class, 'category_item')->withTimestamps();
    }

    //商品へのいいねを取得
    public function likes()
    {
        return $this->hasMany(Like::class);
    }

    //商品へのコメント一覧を取得
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    //商品の購入情報を取得
    public function purchase()
    {
        return $this->hasOne(Purchase::class);
    }

    //商品にいいねしたユーザー一覧を取得(created_atやupdated_atも併せて自動更新)
    public function likedUsers()
    {
        return $this->belongsToMany(User::class, 'likes')->withTimestamps();
    }
}
