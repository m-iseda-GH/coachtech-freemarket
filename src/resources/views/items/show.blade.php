<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>商品詳細</title>

    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            color: #333;
            background: #fff;
        }

        a {
            color: #333;
            text-decoration: none;
        }

        button {
            cursor: pointer;
        }

        .header {
            height: 70px;
            padding: 0 40px;
            display: flex;
            align-items: center;
            gap: 32px;
            border-bottom: 1px solid #ddd;
        }

        .header__logo img {
            width: 180px;
            display: block;
        }

        .header__nav {
            display: flex;
            align-items: center;
            gap: 24px;
        }

        .header__logout-button {
            border: none;
            background: none;
            font-size: 16px;
            color: #333;
        }

        .container {
            max-width: 1200px;
            margin: 40px auto;
            padding: 0 40px;
        }

        .detail {
            display: grid;
            grid-template-columns: 45% 55%;
            gap: 56px;
            align-items: flex-start;
        }

        .detail__image-area {
            width: 100%;
        }

        .detail__image {
            width: 100%;
            max-width: 500px;
            height: 500px;
            object-fit: cover;
            background: #f2f2f2;
        }

        .detail__content {
            width: 100%;
        }

        .detail__name {
            font-size: 32px;
            font-weight: bold;
            margin: 0 0 8px;
        }

        .detail__brand {
            font-size: 14px;
            margin: 0 0 24px;
        }

        .detail__price {
            font-size: 28px;
            margin: 0 0 20px;
        }

        .sold-label {
            display: inline-block;
            color: #fff;
            background: #ff5555;
            padding: 6px 12px;
            border-radius: 4px;
            font-weight: bold;
            margin-bottom: 16px;
        }

        .reaction {
            display: flex;
            gap: 32px;
            margin-bottom: 24px;
        }

        .reaction__item {
            text-align: center;
        }

        .reaction__button {
            border: none;
            background: none;
            padding: 0;
        }

        .reaction__icon {
            width: 36px;
            height: 36px;
            object-fit: contain;
        }

        .reaction__count {
            margin: 4px 0 0;
            font-size: 16px;
        }

        .purchase-button {
            display: block;
            width: 100%;
            max-width: 520px;
            padding: 14px 0;
            background: #ff5555;
            color: #fff;
            border-radius: 4px;
            text-align: center;
            font-size: 20px;
            font-weight: bold;
            margin-bottom: 24px;
        }

        .delete-button {
            display: block;
            width: 100%;
            max-width: 520px;
            padding: 12px 0;
            background: #fff;
            color: #ff5555;
            border: 1px solid #ff5555;
            border-radius: 4px;
            text-align: center;
            font-size: 18px;
            font-weight: bold;
            margin-bottom: 24px;
        }

        .message {
            margin-bottom: 24px;
            color: green;
        }

        .error-message {
            margin-bottom: 24px;
            color: red;
        }

        .section {
            margin-top: 32px;
        }

        .section__title {
            font-size: 24px;
            font-weight: bold;
            margin-bottom: 16px;
        }

        .description {
            line-height: 1.8;
            white-space: pre-wrap;
        }

        .info-row {
            display: flex;
            align-items: flex-start;
            gap: 24px;
            margin-bottom: 16px;
        }

        .info-row__label {
            min-width: 120px;
            font-weight: bold;
        }

        .category-list {
            display: flex;
            flex-wrap: wrap;
            gap: 8px;
        }

        .category-tag {
            display: inline-block;
            padding: 4px 12px;
            background: #f0f0f0;
            border-radius: 16px;
            font-size: 14px;
        }

        .comments {
            max-width: 1200px;
            margin: 48px auto 0;
            padding: 0 40px 40px;
        }

        .comment {
            margin-bottom: 24px;
        }

        .comment__user {
            font-weight: bold;
            margin-bottom: 8px;
        }

        .comment__body {
            background: #f5f5f5;
            padding: 12px;
            border-radius: 4px;
            white-space: pre-wrap;
        }

        .comment-form textarea {
            width: 100%;
            max-width: 700px;
            min-height: 120px;
            padding: 10px;
            font-size: 16px;
        }

        .comment-form button {
            display: block;
            width: 100%;
            max-width: 700px;
            margin-top: 16px;
            padding: 12px 0;
            background: #ff5555;
            color: #fff;
            border: none;
            border-radius: 4px;
            font-size: 18px;
            font-weight: bold;
        }
    </style>
</head>
<body>
    {{-- ヘッダー --}}
    <header class="header">
        <a href="{{ url('/') }}" class="header__logo">
            <img
                src="{{ asset('images/header-logo.png') }}"
                alt="COACHTECH"
            >
        </a>

        <nav class="header__nav">
            <a href="{{ url('/') }}">商品一覧</a>

            @auth
                <a href="{{ route('mypage.index') }}">マイページ</a>
                <a href="{{ route('items.create') }}">出品</a>

                <form action="{{ url('/logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="header__logout-button">
                        ログアウト
                    </button>
                </form>
            @else
                <a href="{{ url('/login') }}">ログイン</a>
                <a href="{{ url('/register') }}">会員登録</a>
            @endauth
        </nav>
    </header>

    <main class="container">
        @if (session('message'))
            <p class="message">{{ session('message') }}</p>
        @endif

        @if (session('error'))
            <p class="error-message">{{ session('error') }}</p>
        @endif

        <div class="detail">
            {{-- 商品画像 --}}
            <div class="detail__image-area">
                @if (\Illuminate\Support\Str::startsWith($item->image, ['http://', 'https://']))
                    <img
                        src="{{ $item->image }}"
                        alt="{{ $item->name }}"
                        class="detail__image"
                    >
                @else
                    <img
                        src="{{ asset('storage/' . $item->image) }}"
                        alt="{{ $item->name }}"
                        class="detail__image"
                    >
                @endif
            </div>

            {{-- 商品情報 --}}
            <div class="detail__content">
                <h1 class="detail__name">{{ $item->name }}</h1>

                <p class="detail__brand">
                    ブランド：{{ $item->brand_name ?? 'なし' }}
                </p>

                <p class="detail__price">
                    ¥{{ number_format($item->price) }}
                </p>

                @if ($item->is_sold)
                    <p class="sold-label">Sold</p>
                @endif

                {{-- いいね・コメント数 --}}
                <div class="reaction">
                    <div class="reaction__item">
                        @auth
                            <form action="{{ route('items.like', $item) }}" method="POST">
                                @csrf

                                <button type="submit" class="reaction__button">
                                    @if ($isLiked)
                                        <img
                                            src="{{ asset('images/like-icon-active.png') }}"
                                            alt="いいね済み"
                                            class="reaction__icon"
                                        >
                                    @else
                                        <img
                                            src="{{ asset('images/like-icon-default.png') }}"
                                            alt="いいね"
                                            class="reaction__icon"
                                        >
                                    @endif
                                </button>
                            </form>
                        @else
                            <a href="{{ url('/login') }}">
                                <img
                                    src="{{ asset('images/like-icon-default.png') }}"
                                    alt="いいね"
                                    class="reaction__icon"
                                >
                            </a>
                        @endauth

                        <p class="reaction__count">{{ $item->likes_count }}</p>
                    </div>

                    <div class="reaction__item">
                        <img
                            src="{{ asset('images/comment-icon.png') }}"
                            alt="コメント"
                            class="reaction__icon"
                        >
                        <p class="reaction__count">{{ $item->comments_count }}</p>
                    </div>
                </div>

                {{-- 購入・削除 --}}
                <div>
                    @auth
                        @if ($item->user_id === auth()->id())
                            @if (!$item->is_sold)
                                <form
                                    action="{{ route('items.destroy', $item) }}"
                                    method="POST"
                                    onsubmit="return confirm('この商品を削除しますか？');"
                                >
                                    @csrf
                                    @method('DELETE')

                                    <button type="submit" class="delete-button">
                                        商品を削除する
                                    </button>
                                </form>
                            @else
                                <p class="error-message">購入済みの商品は削除できません。</p>
                            @endif
                        @else
                            @if (!$item->is_sold)
                                <a href="{{ route('purchase.show', $item) }}" class="purchase-button">
                                    購入手続きへ
                                </a>
                            @else
                                <p class="error-message">この商品は売り切れです。</p>
                            @endif
                        @endif
                    @else
                        @if (!$item->is_sold)
                            <a href="{{ url('/login') }}" class="purchase-button">
                                ログインして購入する
                            </a>
                        @else
                            <p class="error-message">この商品は売り切れです。</p>
                        @endif
                    @endauth
                </div>

                {{-- 商品説明 --}}
                <section class="section">
                    <h2 class="section__title">商品説明</h2>
                    <p class="description">{{ $item->description }}</p>
                </section>

                {{-- 商品情報 --}}
                <section class="section">
                    <h2 class="section__title">商品の情報</h2>

                    <div class="info-row">
                        <div class="info-row__label">カテゴリー</div>
                        <div class="category-list">
                            @foreach ($item->categories as $category)
                                <span class="category-tag">
                                    {{ $category->name }}
                                </span>
                            @endforeach
                        </div>
                    </div>

                    <div class="info-row">
                        <div class="info-row__label">商品の状態</div>
                        <div>
                            {{ $item->condition->name }}
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </main>

    {{-- コメント --}}
    <section class="comments">
        <h2 class="section__title">コメント</h2>

        @if ($item->comments->isEmpty())
            <p>コメントはまだありません。</p>
        @else
            @foreach ($item->comments as $comment)
                <div class="comment">
                    <p class="comment__user">{{ $comment->user->name }}</p>
                    <p class="comment__body">{{ $comment->comment }}</p>
                </div>
            @endforeach
        @endif

        <div class="section">
            <h2 class="section__title">商品へのコメント</h2>

            @auth
                <form
                    action="{{ route('items.comment', $item) }}"
                    method="POST"
                    class="comment-form"
                >
                    @csrf

                    <textarea name="comment">{{ old('comment') }}</textarea>

                    @error('comment')
                        <p class="error-message">{{ $message }}</p>
                    @enderror

                    <button type="submit">
                        コメントを送信する
                    </button>
                </form>
            @else
                <p>
                    コメントするには
                    <a href="{{ url('/login') }}">ログイン</a>
                    してください。
                </p>
            @endauth
        </div>
    </section>
</body>
</html>