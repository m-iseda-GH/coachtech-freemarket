<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>会員登録</title>
</head>
<body>
    {{-- ヘッダー --}}
    <header style="margin-bottom: 24px; display: flex; align-items: center; gap: 24px;">
        {{-- ロゴから商品一覧へ移動 --}}
        <a href="{{ url('/') }}">
            <img
                src="{{ asset('images/header-logo.png') }}"
                alt="COACHTECH"
                width="180"
            >
        </a>

        {{-- 商品一覧へのリンク --}}
        <a href="{{ url('/') }}">商品一覧</a>

        {{-- ログイン状態に応じてメニューを切り替え --}}
        @auth
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

    {{-- 会員登録フォーム --}}
    <h1>会員登録</h1>

    <form action="{{ route('register') }}" method="POST">
        @csrf

        {{-- ユーザー名入力 --}}
        <div>
            <label for="name">ユーザー名</label><br>
            <input
                type="text"
                id="name"
                name="name"
                value="{{ old('name') }}"
            >

            {{-- ユーザー名のバリデーションエラー --}}
            @error('name')
                <p style="color: red;">{{ $message }}</p>
            @enderror
        </div>

        {{-- メールアドレス入力 --}}
        <div style="margin-top: 16px;">
            <label for="email">メールアドレス</label><br>
            <input
                type="email"
                id="email"
                name="email"
                value="{{ old('email') }}"
            >

            {{-- メールアドレスのバリデーションエラー --}}
            @error('email')
                <p style="color: red;">{{ $message }}</p>
            @enderror
        </div>

        {{-- パスワード入力 --}}
        <div style="margin-top: 16px;">
            <label for="password">パスワード</label><br>
            <input
                type="password"
                id="password"
                name="password"
            >

            {{-- パスワードのバリデーションエラー --}}
            @error('password')
                <p style="color: red;">{{ $message }}</p>
            @enderror
        </div>

        {{-- 確認用パスワード入力 --}}
        <div style="margin-top: 16px;">
            <label for="password_confirmation">確認用パスワード</label><br>
            <input
                type="password"
                id="password_confirmation"
                name="password_confirmation"
            >

            {{-- 確認用パスワードのバリデーションエラー --}}
            @error('password_confirmation')
                <p style="color: red;">{{ $message }}</p>
            @enderror
        </div>

        {{-- 会員登録ボタン --}}
        <div style="margin-top: 24px;">
            <button type="submit">登録する</button>
        </div>
    </form>
</body>
</html>