<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MypageController extends Controller
{
    // マイページを表示
    public function index(Request $request)
    {
        // ログインユーザーを取得
        $user = Auth::user();

        // URLから表示対象を選択し、未指定の場合は出品商品を表示
        $page = $request->query('page', 'sell');

        // 購入した商品を表示する場合
        if ($page === 'buy') {
            // 購入履歴から商品情報を取得
            $items = $user->purchases()
                ->with('item')
                ->latest()
                ->get()
                ->pluck('item')
                ->filter();
        } else {
            // 出品した商品を取得
            $page = 'sell';

            $items = $user->items()
                ->latest()
                ->get();
        }

        return view('mypage.index', compact('user', 'items', 'page'));
    }
}
