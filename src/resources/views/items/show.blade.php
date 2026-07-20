<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>商品詳細</title>

    <style>
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            overflow-x: hidden;
            font-family: Arial, "Helvetica Neue", sans-serif;
            color: #000;
            background: #fff;
        }

        a {
            color: inherit;
            text-decoration: none;
        }

        button {
            cursor: pointer;
            font-family: inherit;
        }

        .header {
            width: 100%;
            height: 62px;
            background: #000;
            display: flex;
            align-items: center;
            padding-left: 19px;
            padding-right: 21px;
        }

        .header__logo-link {
            display: flex;
            align-items: center;
            flex-shrink: 0;
        }

        .header__logo {
            width: 272px;
            display: block;
        }

        .header__search {
            width: 496px;
            margin: 0 auto;
        }

        .header__search-input {
            width: 100%;
            height: 40px;
            padding: 0 24px;
            border: none;
            border-radius: 4px;
            color: #000;
            font-size: 19px;
            text-align: center;
        }

        .header__search-input::placeholder {
            color: #000;
            opacity: 1;
        }

        .header__nav {
            display: flex;
            align-items: center;
            gap: 27px;
            flex-shrink: 0;
        }

        .header__link,
        .header__logout {
            color: #fff;
            background: none;
            border: none;
            font-size: 19px;
            text-decoration: none;
            cursor: pointer;
        }

        .header__logout {
            padding: 0;
        }

        .header__sell {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 80px;
            height: 40px;
            border-radius: 4px;
            background: #fff;
            color: #000;
            font-size: 19px;
            text-decoration: none;
        }

        .content-scale {
            width: 142.857%;
            min-height: 142.857vh;
            transform: scale(0.7);
            transform-origin: top left;
        }

        .container {
            width: 1280px;
            margin: 88px auto 0;
        }

        .detail {
            display: grid;
            grid-template-columns: 600px 1fr;
            column-gap: 110px;
            align-items: flex-start;
        }

        .detail__image-area {
            width: 600px;
        }

        .detail__image {
            width: 600px;
            height: 600px;
            object-fit: cover;
            display: block;
            background: #d9d9d9;
        }

        .detail__content {
            width: 100%;
            padding-top: 0;
        }

        .detail__name {
            margin: 0 0 6px;
            font-size: 36px;
            font-weight: 700;
            line-height: 1.25;
        }

        .detail__brand {
            margin: 0 0 28px;
            font-size: 18px;
            line-height: 1.4;
        }

        .detail__price {
            margin: 0 0 22px;
            font-size: 34px;
            line-height: 1;
        }

        .detail__tax {
            font-size: 22px;
        }

        .reaction {
            display: flex;
            align-items: flex-start;
            gap: 34px;
            margin-bottom: 22px;
            padding-left: 34px;
        }

        .reaction__item {
            width: 42px;
            text-align: center;
        }

        .reaction__item form {
            margin: 0;
        }

        .reaction__button {
            border: none;
            background: none;
            padding: 0;
        }

        .reaction__icon {
            width: 40px;
            height: 40px;
            object-fit: contain;
            display: block;
        }

        .reaction__icon--disabled {
            cursor: not-allowed;
            opacity: 0.7;
        }

        .reaction__count {
            margin: 5px 0 0;
            font-size: 14px;
            font-weight: 700;
        }

        .purchase-button {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 100%;
            height: 56px;
            margin: 0 0 32px;
            border: none;
            border-radius: 4px;
            background: #ff5555;
            color: #fff;
            font-size: 24px;
            font-weight: 700;
            text-align: center;
        }

        .delete-button {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 100%;
            height: 56px;
            margin: 0 0 32px;
            border: 1px solid #ff5555;
            border-radius: 4px;
            background: #fff;
            color: #ff5555;
            font-size: 22px;
            font-weight: 700;
            text-align: center;
        }

        .sold-message,
        .error-message {
            margin: 0 0 28px;
            color: #ff0000;
            font-size: 16px;
        }

        .message {
            width: 1280px;
            margin: 0 auto 24px;
            color: green;
            font-size: 16px;
        }

        .section {
            margin-top: 34px;
        }

        .section__title {
            margin: 0 0 28px;
            font-size: 28px;
            font-weight: 700;
            line-height: 1.3;
        }

        .description {
            margin: 0;
            font-size: 18px;
            line-height: 1.8;
            white-space: pre-wrap;
        }

        .info-row {
            display: flex;
            align-items: center;
            margin-bottom: 22px;
            font-size: 16px;
        }

        .info-row__label {
            width: 150px;
            font-size: 17px;
            font-weight: 700;
        }

        .category-list {
            display: flex;
            flex-wrap: wrap;
            gap: 14px;
        }

        .category-tag {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            min-width: 74px;
            height: 26px;
            padding: 0 16px;
            border-radius: 20px;
            background: #e5e5e5;
            font-size: 14px;
        }

        .comments {
            margin-top: 48px;
        }

        .comments__title {
            margin: 0 0 20px;
            color: #5f5f5f;
            font-size: 28px;
            font-weight: 700;
        }

        .comment {
            margin-bottom: 24px;
        }

        .comment__user {
            display: flex;
            align-items: center;
            gap: 14px;
            margin-bottom: 14px;
        }

        .comment__avatar {
            width: 56px;
            height: 56px;
            border-radius: 50%;
            background: #d9d9d9;
            object-fit: cover;
            flex-shrink: 0;
        }

        .comment__name {
            margin: 0;
            font-size: 22px;
            font-weight: 700;
        }

        .comment__body {
            width: 100%;
            margin: 0;
            padding: 14px 16px;
            border-radius: 4px;
            background: #e5e5e5;
            font-size: 16px;
            line-height: 1.6;
            white-space: pre-wrap;
        }

        .comment-empty {
            margin: 0 0 24px;
            font-size: 16px;
        }

        .comment-form {
            margin-top: 28px;
        }

        .comment-form__label {
            display: block;
            margin-bottom: 8px;
            font-size: 22px;
            font-weight: 700;
        }

        .comment-form textarea {
            width: 100%;
            height: 180px;
            padding: 12px;
            border: 1px solid #5f5f5f;
            border-radius: 4px;
            font-size: 16px;
            resize: vertical;
        }

        .comment-form button {
            width: 100%;
            height: 56px;
            margin-top: 28px;
            border: none;
            border-radius: 4px;
            background: #ff5555;
            color: #fff;
            font-size: 20px;
            font-weight: 700;
        }

        @media screen and (max-width: 900px) {
            .content-scale {
                width: 100%;
                min-height: 100vh;
                transform: none;
            }

            .header {
                height: auto;
                min-height: 62px;
                flex-wrap: wrap;
                padding: 14px 18px;
            }

            .header__logo {
                width: 230px;
            }

            .header__search {
                order: 3;
                width: 100%;
                margin-top: 12px;
            }

            .header__search-input {
                font-size: 18px;
            }

            .header__nav {
                margin-left: auto;
                gap: 18px;
            }

            .header__link,
            .header__logout {
                font-size: 17px;
            }

            .header__sell {
                width: 74px;
                height: 38px;
                font-size: 17px;
            }

            .container {
                width: 100%;
                margin: 40px auto 0;
                padding: 0 24px;
            }

            .detail {
                display: block;
            }

            .detail__image-area,
            .detail__image {
                width: 100%;
            }

            .detail__image {
                height: auto;
                aspect-ratio: 1 / 1;
            }

            .detail__content {
                margin-top: 32px;
            }
        }

        @media screen and (max-width: 600px) {
            .header__nav {
                width: 100%;
                justify-content: space-between;
                gap: 10px;
                margin-top: 12px;
            }

            .header__link,
            .header__logout,
            .header__sell {
                font-size: 16px;
            }

            .detail__name {
                font-size: 28px;
            }

            .detail__price {
                font-size: 26px;
            }

            .section__title,
            .comments__title {
                font-size: 24px;
            }
        }
    </style>
</head>
<body>
    <header class="header">
        <a class="header__logo-link" href="{{ url('/') }}">
            <img
                class="header__logo"
                src="{{ asset('images/header-logo.png') }}"
                alt="COACHTECH"
            >
        </a>

        <form class="header__search" action="{{ url('/') }}" method="GET">
            <input
                class="header__search-input"
                type="text"
                name="keyword"
                placeholder="なにをお探しですか？"
            >
        </form>

        <nav class="header__nav">
            @auth
                <form action="{{ url('/logout') }}" method="POST">
                    @csrf
                    <button class="header__logout" type="submit">ログアウト</button>
                </form>
            @else
                <a class="header__link" href="{{ url('/login') }}">ログイン</a>
            @endauth

            <a class="header__link" href="{{ route('mypage.index') }}">マイページ</a>
            <a class="header__sell" href="{{ route('items.create') }}">出品</a>
        </nav>
    </header>

    <div class="content-scale">
        <main class="container">
            @if (session('message'))
                <p class="message">{{ session('message') }}</p>
            @endif

            @if (session('error'))
                <p class="error-message">{{ session('error') }}</p>
            @endif

            <div class="detail">
                <div class="detail__image-area">
                    @if (\Illuminate\Support\Str::startsWith($item->image, ['http://', 'https://']))
                        <img
                            class="detail__image"
                            src="{{ $item->image }}"
                            alt="{{ $item->name }}"
                        >
                    @else
                        <img
                            class="detail__image"
                            src="{{ asset('storage/' . $item->image) }}"
                            alt="{{ $item->name }}"
                        >
                    @endif
                </div>

                <div class="detail__content">
                    <h1 class="detail__name">{{ $item->name }}</h1>

                    <p class="detail__brand">
                        ブランド：{{ $item->brand_name ?? 'なし' }}
                    </p>

                    <p class="detail__price">
                        ¥{{ number_format($item->price) }}
                        <span class="detail__tax">（税込）</span>
                    </p>

                    <div class="reaction">
                        <div class="reaction__item">
                            @if ($item->is_sold)
                                @if ($isLiked)
                                    <img
                                        class="reaction__icon reaction__icon--disabled"
                                        src="{{ asset('images/like-icon-active.png') }}"
                                        alt="いいね済み"
                                    >
                                @else
                                    <img
                                        class="reaction__icon reaction__icon--disabled"
                                        src="{{ asset('images/like-icon-default.png') }}"
                                        alt="いいね不可"
                                    >
                                @endif
                            @else
                                @auth
                                    <form action="{{ route('items.like', $item) }}" method="POST">
                                        @csrf

                                        <button class="reaction__button" type="submit">
                                            @if ($isLiked)
                                                <img
                                                    class="reaction__icon"
                                                    src="{{ asset('images/like-icon-active.png') }}"
                                                    alt="いいね済み"
                                                >
                                            @else
                                                <img
                                                    class="reaction__icon"
                                                    src="{{ asset('images/like-icon-default.png') }}"
                                                    alt="いいね"
                                                >
                                            @endif
                                        </button>
                                    </form>
                                @else
                                    <a href="{{ url('/login') }}">
                                        <img
                                            class="reaction__icon"
                                            src="{{ asset('images/like-icon-default.png') }}"
                                            alt="いいね"
                                        >
                                    </a>
                                @endauth
                            @endif

                            <p class="reaction__count">{{ $item->likes_count }}</p>
                        </div>

                        <div class="reaction__item">
                            <img
                                class="reaction__icon"
                                src="{{ asset('images/comment-icon.png') }}"
                                alt="コメント"
                            >
                            <p class="reaction__count">{{ $item->comments_count }}</p>
                        </div>
                    </div>

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

                                    <button class="delete-button" type="submit">
                                        商品を削除する
                                    </button>
                                </form>
                            @else
                                <p class="sold-message">購入済みの商品は削除できません。</p>
                            @endif
                        @else
                            @if (!$item->is_sold)
                                <a class="purchase-button" href="{{ route('purchase.show', $item) }}">
                                    購入手続きへ
                                </a>
                            @else
                                <p class="sold-message">この商品は売り切れです。</p>
                            @endif
                        @endif
                    @else
                        @if (!$item->is_sold)
                            <a class="purchase-button" href="{{ route('purchase.show', $item) }}">
                                購入手続きへ
                            </a>
                        @else
                            <p class="sold-message">この商品は売り切れです。</p>
                        @endif
                    @endauth

                    <section class="section">
                        <h2 class="section__title">商品説明</h2>
                        <p class="description">{{ $item->description }}</p>
                    </section>

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
                            <div>{{ $item->condition->name }}</div>
                        </div>
                    </section>

                    <section class="comments">
                        <h2 class="comments__title">
                            コメント({{ $item->comments_count }})
                        </h2>

                        @if ($item->comments->isEmpty())
                            <p class="comment-empty">コメントはまだありません。</p>
                        @else
                            @foreach ($item->comments as $comment)
                                <div class="comment">
                                    <div class="comment__user">
                                        @if ($comment->user->profile_image)
                                            <img
                                                class="comment__avatar"
                                                src="{{ asset('storage/' . $comment->user->profile_image) }}"
                                                alt="{{ $comment->user->name }}"
                                            >
                                        @else
                                            <div class="comment__avatar"></div>
                                        @endif

                                        <p class="comment__name">
                                            {{ $comment->user->name }}
                                        </p>
                                    </div>

                                    <p class="comment__body">
                                        {{ $comment->comment }}
                                    </p>
                                </div>
                            @endforeach
                        @endif

                        <div class="comment-form">
                            <label class="comment-form__label" for="comment">
                                商品へのコメント
                            </label>

                            @if ($item->is_sold)
                                <p class="sold-message">
                                    売り切れの商品にはコメントできません。
                                </p>
                            @else
                                @auth
                                    <form action="{{ route('items.comment', $item) }}" method="POST">
                                        @csrf

                                        <textarea id="comment" name="comment">{{ old('comment') }}</textarea>

                                        @error('comment')
                                            <p class="error-message">{{ $message }}</p>
                                        @enderror

                                        <button type="submit">
                                            コメントを送信する
                                        </button>
                                    </form>
                                @else
                                    <form action="{{ url('/login') }}" method="GET">
                                        <textarea id="comment" name="comment">{{ old('comment') }}</textarea>

                                        <button type="submit">
                                            コメントを送信する
                                        </button>
                                    </form>
                                @endauth
                            @endif
                        </div>
                    </section>
                </div>
            </div>
        </main>
    </div>
</body>
</html>