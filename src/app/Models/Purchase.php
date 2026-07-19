<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Purchase extends Model
{
    use HasFactory;

    // 一括代入を許可するカラム
    protected $fillable = [
        'user_id',
        'item_id',
        'payment_method',
        'postal_code',
        'address',
        'building',
    ];

    // 購入したユーザー
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // 購入された商品
    public function item()
    {
        return $this->belongsTo(Item::class);
    }
}
