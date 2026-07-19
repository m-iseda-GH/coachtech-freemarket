<?php

namespace App\Http\Controllers;

use App\Http\Requests\PurchaseAddressRequest;
use App\Http\Requests\PurchaseRequest;
use App\Models\Item;
use App\Models\Purchase;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PurchaseController extends Controller
{
    // 購入画面を表示
    public function show(Item $item)
    {
        // ログインユーザーを取得
        $user = Auth::user();

        // セッションの一時住所、またはプロフィール住所を取得
        $shippingAddress = $this->getShippingAddress($item, $user);

        // 商品情報・ユーザー情報・配送先住所を購入画面へ渡す
        return view('purchases.show', compact('item', 'user', 'shippingAddress'));
    }

    // 商品の購入処理
    public function store(PurchaseRequest $request, Item $item)
    {
        // 購入者となるログインユーザーを取得
        $user = Auth::user();

        // 自分が出品した商品の購入を防止
        if ($item->user_id === $user->id) {
            return redirect()
                ->route('items.show', $item)
                ->with('error', '自分の商品は購入できません');
        }

        // すでに売れている商品の再購入を防止
        if ($item->is_sold) {
            return redirect()
                ->route('items.show', $item)
                ->with('error', 'この商品はすでに購入されています');
        }

        // 今回の購入で使用する配送先住所を取得
        $shippingAddress = $this->getShippingAddress($item, $user);

        // 郵便番号または住所が未登録の場合は購入不可
        if (!$shippingAddress['postal_code'] || !$shippingAddress['address']) {
            return redirect('/mypage/profile')
                ->with('error', '購入前に配送先住所を登録してください');
        }

        // バリデーションを通過した支払い方法を取得
        $validated = $request->validated();

        // 購入情報の保存と商品状態の更新をまとめて実行
        DB::transaction(function () use ($item, $user, $validated, $shippingAddress) {
            // 購入時点の支払い方法と配送先住所を保存
            Purchase::create([
                'user_id' => $user->id,
                'item_id' => $item->id,
                'payment_method' => $validated['payment_method'],
                'postal_code' => $shippingAddress['postal_code'],
                'address' => $shippingAddress['address'],
                'building' => $shippingAddress['building'],
            ]);

            // 商品を購入済みに変更
            $item->update([
                'is_sold' => true,
            ]);
        });

        // 購入手続き中に一時保存した配送先住所を削除
        session()->forget('purchase_address.' . $item->id);

        // 商品一覧画面へ戻る
        return redirect('/')
            ->with('message', '商品を購入しました');
    }

    // 配送先住所の変更画面を表示
    public function editAddress(Item $item)
    {
        // ログインユーザーを取得
        $user = Auth::user();

        // 現在使用している配送先住所を取得
        $shippingAddress = $this->getShippingAddress($item, $user);

        // 商品情報と配送先住所を変更画面へ渡す
        return view('purchases.address', compact('item', 'shippingAddress'));
    }

    // 購入手続き中の配送先住所を変更
    public function updateAddress(PurchaseAddressRequest $request, Item $item)
    {
        // バリデーションを通過した住所情報を取得
        $validated = $request->validated();

        // 変更した配送先住所を商品ごとにセッションへ一時保存
        session([
            'purchase_address.' . $item->id => [
                'postal_code' => $validated['postal_code'],
                'address' => $validated['address'],
                'building' => $validated['building'] ?? null,
            ],
        ]);

        // 変更後の住所を反映するため購入画面へ戻る
        return redirect()
            ->route('purchase.show', $item)
            ->with('message', '配送先住所を変更しました');
    }

    // 購入手続きで使用する配送先住所を取得
    private function getShippingAddress(Item $item, $user): array
    {
        // セッションに変更後の住所があれば使用、ない場合はユーザーのプロフィール住所を使用
        return session('purchase_address.' . $item->id, [
            'postal_code' => $user->postal_code,
            'address' => $user->address,
            'building' => $user->building,
        ]);
    }
}
