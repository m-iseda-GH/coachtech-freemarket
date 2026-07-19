<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>商品一覧</title>
</head>
<body>
    {{-- ヘッダー --}}
    <header style="margin-bottom: 24px; display: flex; align-items: center; gap: 24px;">
        {{-- ロゴ --}}
        <a href="{{ url('/') }}">
            <img
                src="{{ asset('images/header-logo.png') }}"
                alt="COACHTECH"
                width="180"
            >
        </a>

        {{-- 商品一覧へのリンク --}}
        <a href="{{ url('/') }}">商品一覧</a>

        @auth
            {{-- ログイン中のメニュー --}}
            <a href="{{ route('mypage.index') }}">マイページ</a>
            <a href="{{ route('items.create') }}">出品</a>

            {{-- ログアウト処理 --}}
            <form action="{{ url('/logout') }}" method="POST" style="display: inline;">
                @csrf
                <button type="submit">ログアウト</button>
            </form>
        @else
            {{-- 未ログイン時のメニュー --}}
            <a href="{{ url('/login') }}">ログイン</a>
            <a href="{{ url('/register') }}">会員登録</a>
        @endauth
    </header>

    <h1>商品一覧</h1>

    {{-- 成功メッセージ --}}
    @if (session('message'))
        <p style="color: green;">{{ session('message') }}</p>
    @endif

    {{-- エラーメッセージ --}}
    @if (session('error'))
        <p style="color: red;">{{ session('error') }}</p>
    @endif

    {{-- 検索フォーム --}}
    <form action="{{ url('/') }}" method="GET" style="margin-bottom: 24px;">
        @if (($tab ?? null) === 'mylist')
            <input type="hidden" name="tab" value="mylist">
        @endif

        <input
            type="text"
            name="keyword"
            value="{{ $keyword ?? '' }}"
            placeholder="なにをお探しですか？"
        >

        <button type="submit">検索</button>
    </form>

    {{-- おすすめ・マイリスト切り替え --}}
    <nav style="display: flex; gap: 24px; border-bottom: 1px solid #ccc; margin-bottom: 24px;">
        <a
            href="{{ url('/') . (($keyword ?? '') ? '?keyword=' . urlencode($keyword) : '') }}"
            style="{{ ($tab ?? null) !== 'mylist' ? 'font-weight: bold; color: red;' : '' }}"
        >
            おすすめ
        </a>

        <a
            href="{{ url('/') . '?tab=mylist' . (($keyword ?? '') ? '&keyword=' . urlencode($keyword) : '') }}"
            style="{{ ($tab ?? null) === 'mylist' ? 'font-weight: bold; color: red;' : '' }}"
        >
            マイリスト
        </a>
    </nav>

    {{-- 商品がない場合 --}}
    @if ($items->isEmpty())
        @if (($tab ?? null) === 'mylist')
            @guest
                <p>マイリストを確認するにはログインしてください。</p>
                <p>
                    <a href="{{ url('/login') }}">ログイン画面へ</a>
                </p>
            @else
                <p>マイリストに商品はありません。</p>
            @endguest
        @else
            <p>商品はありません。</p>
        @endif
    @else
        {{-- 商品一覧 --}}
        <div style="display: flex; flex-wrap: wrap; gap: 24px;">
            @foreach ($items as $item)
                <div style="width: 200px;">
                    {{-- 商品詳細画面へのリンク --}}
                    <a href="{{ route('items.show', $item) }}">
                        {{-- 外部URL画像の場合 --}}
                        @if (\Illuminate\Support\Str::startsWith($item->image, ['http://', 'https://']))
                            <img
                                src="{{ $item->image }}"
                                alt="{{ $item->name }}"
                                width="200"
                            >
                        @else
                            {{-- storageに保存した画像の場合 --}}
                            <img
                                src="{{ asset('storage/' . $item->image) }}"
                                alt="{{ $item->name }}"
                                width="200"
                            >
                        @endif
                    </a>

                    {{-- 購入済み商品の表示 --}}
                    @if ($item->is_sold)
                        <p style="color: red; font-weight: bold;">Sold</p>
                    @endif

                    {{-- 商品情報 --}}
                    <p>{{ $item->name }}</p>
                    <p>¥{{ number_format($item->price) }}</p>
                    <p>ブランド：{{ $item->brand_name ?? 'なし' }}</p>
                    <p>状態：{{ $item->condition->name }}</p>
                </div>
            @endforeach
        </div>
    @endif
</body>
</html>