<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MypageController extends Controller
{
    // マイページを表示
    public function index(Request $request)
    {
        $user = Auth::user();

        // 表示するタブを取得
        $page = $request->query('page', 'sell');

        if ($page === 'buy') {
            // 購入した商品を取得
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
