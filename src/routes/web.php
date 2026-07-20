<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\PurchaseController;
use App\Http\Controllers\MypageController;

// 商品一覧画面
Route::get('/', [ItemController::class, 'index']);

// 商品詳細画面
Route::get('/item/{item}', [ItemController::class, 'show'])
    ->name('items.show');

// 商品削除処理
Route::delete('/item/{item}', [ItemController::class, 'destroy'])
    ->middleware(['auth', 'verified'])
    ->name('items.destroy');

// 商品出品画面
Route::get('/sell', [ItemController::class, 'create'])
    ->middleware(['auth', 'verified'])
    ->name('items.create');

// 商品出品処理
Route::post('/sell', [ItemController::class, 'store'])
    ->middleware(['auth', 'verified'])
    ->name('items.store');

// いいねの追加・削除
Route::post('/item/{item}/like', [ItemController::class, 'toggleLike'])
    ->middleware(['auth', 'verified'])
    ->name('items.like');

// コメント投稿
Route::post('/item/{item}/comment', [ItemController::class, 'storeComment'])
    ->middleware(['auth', 'verified'])
    ->name('items.comment');

// 購入画面
Route::get('/purchase/{item}', [PurchaseController::class, 'show'])
    ->middleware(['auth', 'verified'])
    ->name('purchase.show');

// 購入処理
Route::post('/purchase/{item}', [PurchaseController::class, 'store'])
    ->middleware(['auth', 'verified'])
    ->name('purchase.store');

// 配送先住所変更画面
Route::get('/purchase/address/{item}', [PurchaseController::class, 'editAddress'])
    ->middleware(['auth', 'verified'])
    ->name('purchase.address.edit');

// 配送先住所更新
Route::post('/purchase/address/{item}', [PurchaseController::class, 'updateAddress'])
    ->middleware(['auth', 'verified'])
    ->name('purchase.address.update');

// マイページ・プロフィール関連
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/mypage', [MypageController::class, 'index'])
        ->name('mypage.index');

    Route::get('/mypage/profile', [ProfileController::class, 'edit'])
        ->name('profile.edit');

    Route::post('/mypage/profile', [ProfileController::class, 'update'])
        ->name('profile.update');
});
