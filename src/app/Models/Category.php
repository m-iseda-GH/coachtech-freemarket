<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    //一括代入を許可するカラム
    protected $fillable = ['name'];

    //カテゴリに属する商品一覧を取得(created_atやupdated_atも併せて自動更新)
    public function items()
    {
        return $this->belongsToMany(Item::class, 'category_item')->withTimestamps();
    }
}
