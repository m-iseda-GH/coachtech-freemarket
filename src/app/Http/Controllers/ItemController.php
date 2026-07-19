<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Category;
use App\Models\Condition;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use App\Http\Requests\CommentRequest;
use App\Http\Requests\SellRequest;

class ItemController extends Controller
{
    // 商品一覧画面を表示
    public function index(Request $request)
    {
        $validated = $request->validate([
            'tab' => ['nullable', 'in:mylist'],
            'keyword' => ['nullable', 'string', 'max:255'],
        ]);

        $tab = $validated['tab'] ?? null;
        $keyword = $validated['keyword'] ?? null;

        if ($tab === 'mylist') {
            if (Auth::check()) {
                // ログインユーザーがいいねした商品を取得
                $items = Auth::user()
                    ->likedItems()
                    ->with(['condition', 'categories'])
                    ->when($keyword, function ($query, $keyword) {
                        $query->where(function ($query) use ($keyword) {
                            $query->where('items.name', 'like', '%' . $keyword . '%')
                                ->orWhere('items.brand_name', 'like', '%' . $keyword . '%');
                        });
                    })
                    ->latest('items.created_at')
                    ->get();
            } else {
                // 未ログイン時のマイリストは空で表示
                $items = collect();
            }
        } else {
            // 通常の商品一覧を取得
            $items = Item::with(['condition', 'categories'])
                ->when(Auth::check(), function ($query) {
                    // ログイン中は自分が出品した商品を除外
                    $query->where('user_id', '!=', Auth::id());
                })
                ->when($keyword, function ($query, $keyword) {
                    // 商品名またはブランド名で検索
                    $query->where(function ($query) use ($keyword) {
                        $query->where('items.name', 'like', '%' . $keyword . '%')
                            ->orWhere('items.brand_name', 'like', '%' . $keyword . '%');
                    });
                })
                ->latest()
                ->get();
        }

        return view('items.index', compact('items', 'tab', 'keyword'));
    }

    // 商品出品画面を表示
    public function create()
    {
        $categories = Category::all();
        $conditions = Condition::all();

        return view('items.create', compact('categories', 'conditions'));
    }

    // 商品を登録
    public function store(SellRequest $request)
    {
        $validated = $request->validated();

        // 商品画像を保存
        $imagePath = $request->file('image')->store('items', 'public');

        // 商品情報を保存
        $item = Item::create([
            'user_id' => Auth::id(),
            'condition_id' => $validated['condition_id'],
            'name' => $validated['name'],
            'brand_name' => $validated['brand_name'] ?? null,
            'description' => $validated['description'],
            'price' => $validated['price'],
            'image' => $imagePath,
            'is_sold' => false,
        ]);

        // 商品とカテゴリーを紐づけ
        $item->categories()->attach($validated['category_ids']);

        return redirect()
            ->route('mypage.index', ['page' => 'sell'])
            ->with('message', '商品を出品しました');
    }

    // 商品詳細画面を表示
    public function show(Item $item)
    {
        $item->load(['condition', 'categories', 'comments.user']);
        $item->loadCount(['likes', 'comments']);

        $isLiked = false;

        if (Auth::check()) {
            // ログインユーザーがこの商品をいいね済みか確認
            $isLiked = $item->likes()
                ->where('user_id', Auth::id())
                ->exists();
        }

        return view('items.show', compact('item', 'isLiked'));
    }

    // いいねを追加・解除
    public function toggleLike(Item $item)
    {
        $user = Auth::user();

        $like = $item->likes()
            ->where('user_id', $user->id)
            ->first();

        if ($like) {
            // いいね済みなら解除
            $like->delete();
        } else {
            // 未いいねなら追加
            $item->likes()->create([
                'user_id' => $user->id,
            ]);
        }

        return redirect()->back();
    }

    // コメントを投稿
    public function storeComment(CommentRequest $request, Item $item)
    {
        $validated = $request->validated();

        $item->comments()->create([
            'user_id' => Auth::id(),
            'comment' => $validated['comment'],
        ]);

        return redirect()->route('items.show', $item);
    }

    // 出品商品を削除
    public function destroy(Item $item)
    {
        // 自分が出品した商品以外は削除不可
        if ($item->user_id !== Auth::id()) {
            abort(403);
        }

        // 購入済み商品は削除不可
        if ($item->is_sold) {
            return redirect()
                ->route('items.show', $item)
                ->with('error', '購入済みの商品は削除できません');
        }

        // storage保存画像の場合は画像ファイルも削除
        if (
            $item->image &&
            !Str::startsWith($item->image, ['http://', 'https://'])
        ) {
            Storage::disk('public')->delete($item->image);
        }

        // 関連データを削除
        $item->categories()->detach();
        $item->likes()->delete();
        $item->comments()->delete();

        // 商品本体を削除
        $item->delete();

        return redirect()
            ->route('mypage.index', ['page' => 'sell'])
            ->with('message', '商品を削除しました');
    }
}
