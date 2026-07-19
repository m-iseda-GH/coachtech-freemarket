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
        $user = Auth::user();

        // 購入画面に表示する配送先住所を取得
        $shippingAddress = $this->getShippingAddress($item, $user);

        return view('purchases.show', compact('item', 'user', 'shippingAddress'));
    }

    // 商品を購入
    public function store(PurchaseRequest $request, Item $item)
    {
        $user = Auth::user();

        // 自分が出品した商品は購入不可
        if ($item->user_id === $user->id) {
            return redirect()
                ->route('items.show', $item)
                ->with('error', '自分の商品は購入できません');
        }

        // 購入済み商品は購入不可
        if ($item->is_sold) {
            return redirect()
                ->route('items.show', $item)
                ->with('error', 'この商品はすでに購入されています');
        }

        // 購入時に使用する配送先住所を取得
        $shippingAddress = $this->getShippingAddress($item, $user);

        // 配送先住所が未登録の場合はプロフィール設定へ遷移
        if (!$shippingAddress['postal_code'] || !$shippingAddress['address']) {
            return redirect('/mypage/profile')
                ->with('error', '購入前に配送先住所を登録してください');
        }

        $validated = $request->validated();

        DB::transaction(function () use ($item, $user, $validated, $shippingAddress) {
            // 購入情報を保存
            Purchase::create([
                'user_id' => $user->id,
                'item_id' => $item->id,
                'payment_method' => $validated['payment_method'],
                'postal_code' => $shippingAddress['postal_code'],
                'address' => $shippingAddress['address'],
                'building' => $shippingAddress['building'],
            ]);

            // 商品を購入済みに更新
            $item->update([
                'is_sold' => true,
            ]);
        });

        // 購入後は一時保存した配送先住所を削除
        session()->forget('purchase_address.' . $item->id);

        return redirect('/')
            ->with('message', '商品を購入しました');
    }

    // 配送先住所変更画面を表示
    public function editAddress(Item $item)
    {
        $user = Auth::user();

        $shippingAddress = $this->getShippingAddress($item, $user);

        return view('purchases.address', compact('item', 'shippingAddress'));
    }

    // 配送先住所を一時保存
    public function updateAddress(PurchaseAddressRequest $request, Item $item)
    {
        $validated = $request->validated();

        session([
            'purchase_address.' . $item->id => [
                'postal_code' => $validated['postal_code'],
                'address' => $validated['address'],
                'building' => $validated['building'] ?? null,
            ],
        ]);

        return redirect()
            ->route('purchase.show', $item)
            ->with('message', '配送先住所を変更しました');
    }

    // 購入時に使用する配送先住所を取得
    private function getShippingAddress(Item $item, $user): array
    {
        return session('purchase_address.' . $item->id, [
            'postal_code' => $user->postal_code,
            'address' => $user->address,
            'building' => $user->building,
        ]);
    }
}
