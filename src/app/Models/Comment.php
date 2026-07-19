<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    //一括代入を許可するカラム
    protected $fillable = [
        'user_id',
        'item_id',
        'comment',
    ];

    // コメントを投稿したユーザーを取得
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // コメントが投稿された商品を取得
    public function item()
    {
        return $this->belongsTo(Item::class);
    }
}
