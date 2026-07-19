<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    // 一括代入を許可するカラム
    protected $fillable = [
        'name',
    ];

    // このカテゴリーに紐づく商品
    public function items()
    {
        return $this->belongsToMany(Item::class, 'category_item')
            ->withTimestamps();
    }
}
