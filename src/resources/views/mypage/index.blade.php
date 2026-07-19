<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>マイページ</title>
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

    <h1>マイページ</h1>

    {{-- 成功メッセージ --}}
    @if (session('message'))
        <p style="color: green;">{{ session('message') }}</p>
    @endif

    {{-- エラーメッセージ --}}
    @if (session('error'))
        <p style="color: red;">{{ session('error') }}</p>
    @endif

    {{-- プロフィール情報 --}}
    <section style="display: flex; align-items: center; gap: 24px; margin-bottom: 32px;">
        <div>
            {{-- プロフィール画像が登録されている場合 --}}
            @if ($user->profile_image)
                <img
                    src="{{ asset('storage/' . $user->profile_image) }}"
                    alt="{{ $user->name }}"
                    width="120"
                    height="120"
                    style="border-radius: 50%; object-fit: cover;"
                >
            @else
                {{-- プロフィール画像が未登録の場合 --}}
                <div
                    style="
                        width: 120px;
                        height: 120px;
                        border-radius: 50%;
                        background: #ddd;
                    "
                ></div>
            @endif
        </div>

        <div>
            {{-- ユーザー名 --}}
            <h2>{{ $user->name }}</h2>

            {{-- プロフィール編集画面へのリンク --}}
            <p>
                <a href="{{ route('profile.edit') }}">
                    プロフィールを編集
                </a>
            </p>
        </div>
    </section>

    {{-- 出品商品・購入商品の切り替え --}}
    <nav style="display: flex; gap: 24px; border-bottom: 1px solid #ccc; margin-bottom: 24px;">
        <a
            href="{{ route('mypage.index', ['page' => 'sell']) }}"
            style="{{ $page === 'sell' ? 'font-weight: bold; color: red;' : '' }}"
        >
            出品した商品
        </a>

        <a
            href="{{ route('mypage.index', ['page' => 'buy']) }}"
            style="{{ $page === 'buy' ? 'font-weight: bold; color: red;' : '' }}"
        >
            購入した商品
        </a>
    </nav>

    {{-- 商品がない場合 --}}
    @if ($items->isEmpty())
        @if ($page === 'buy')
            <p>購入した商品はありません。</p>
        @else
            <p>出品した商品はありません。</p>
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

                    {{-- 商品名と販売価格 --}}
                    <p>{{ $item->name }}</p>
                    <p>¥{{ number_format($item->price) }}</p>
                </div>
            @endforeach
        </div>
    @endif
</body>
</html>