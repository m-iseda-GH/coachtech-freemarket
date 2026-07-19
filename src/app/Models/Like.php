<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
    use HasFactory;

    //一括代入を許可するカラム
    protected $fillable = [
        'user_id',
        'item_id',
    ];

    // いいねしたユーザーを取得
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    //いいねされた商品を取得
    public function item()
    {
        return $this->belongsTo(Item::class);
    }
}
