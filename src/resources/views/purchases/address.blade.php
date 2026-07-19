<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>配送先住所変更</title>
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

    {{-- 購入画面へ戻るリンク --}}
    <a href="{{ route('purchase.show', $item) }}">購入画面へ戻る</a>

    <h1>配送先住所の変更</h1>

    {{-- 変更した配送先住所を送信 --}}
    <form action="{{ route('purchase.address.update', $item) }}" method="POST">
        @csrf

        {{-- 郵便番号 --}}
        <div>
            <label for="postal_code">郵便番号</label><br>
            <input
                type="text"
                id="postal_code"
                name="postal_code"
                value="{{ old('postal_code', $shippingAddress['postal_code']) }}"
            >

            {{-- 郵便番号のバリデーションエラー --}}
            @error('postal_code')
                <p style="color: red;">{{ $message }}</p>
            @enderror
        </div>

        {{-- 住所 --}}
        <div style="margin-top: 16px;">
            <label for="address">住所</label><br>
            <input
                type="text"
                id="address"
                name="address"
                value="{{ old('postal_code', $shippingAddress['postal_code'] ?? '') }}"
            >

            {{-- 住所のバリデーションエラー --}}
            @error('address')
                <p style="color: red;">{{ $message }}</p>
            @enderror
        </div>

        {{-- 建物名 --}}
        <div style="margin-top: 16px;">
            <label for="building">建物名</label><br>
            <input
                type="text"
                id="building"
                name="building"
                value="{{ old('building', $shippingAddress['building'] ?? '') }}"
            >

            {{-- 建物名のバリデーションエラー --}}
            @error('building')
                <p style="color: red;">{{ $message }}</p>
            @enderror
        </div>

        {{-- 配送先住所を更新 --}}
        <div style="margin-top: 24px;">
            <button type="submit">更新する</button>
        </div>
    </form>
</body>
</html>