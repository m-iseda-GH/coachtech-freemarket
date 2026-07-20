<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>商品一覧</title>

    <style>
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
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

        .tabs {
            width: 100%;
            height: 64px;
            border-bottom: 1px solid #5f5f5f;
            display: flex;
            align-items: flex-end;
            gap: 68px;
            padding-left: 145px;
            padding-bottom: 13px;
        }

        .tabs__link {
            color: #000;
            font-size: 20px;
            font-weight: 700;
        }

        .tabs__link--active {
            color: #ff0000;
        }

        .content {
            width: 100%;
            padding: 46px 0 40px;
        }

        .items {
            width: 1365px;
            margin: 0 auto;
            display: grid;
            grid-template-columns: repeat(4, 270px);
            column-gap: 95px;
            row-gap: 58px;
        }

        .item-card {
            display: block;
            width: 270px;
        }

        .item-card__image-wrap {
            position: relative;
            width: 270px;
            height: 270px;
            background: #d9d9d9;
            overflow: hidden;
        }

        .item-card__image {
            width: 100%;
            height: 100%;
            object-fit: cover;
            display: block;
        }

        .item-card__sold {
            position: absolute;
            top: 12px;
            left: 12px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            min-width: 74px;
            height: 34px;
            padding: 0 12px;
            border-radius: 4px;
            background: rgba(255, 0, 0, 0.9);
            color: #fff;
            font-size: 18px;
            font-weight: 700;
        }

        .item-card__name {
            margin: 10px 0 0;
            font-size: 22px;
            line-height: 1.4;
        }

        .empty-message {
            width: 1365px;
            margin: 0 auto;
            font-size: 20px;
        }

        .login-message {
            width: 1365px;
            margin: 28px auto 0;
            font-size: 20px;
            line-height: 1.8;
        }

        .login-message__link {
            color: #0073cc;
            text-decoration: underline;
        }

        @media screen and (max-width: 1300px) {
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

            .tabs {
                padding-left: 40px;
            }

            .items,
            .empty-message,
            .login-message {
                width: 100%;
                padding: 0 40px;
            }

            .items {
                grid-template-columns: repeat(3, 270px);
                justify-content: center;
                column-gap: 60px;
            }
        }

        @media screen and (max-width: 900px) {
            .items {
                grid-template-columns: repeat(2, 270px);
                column-gap: 40px;
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

            .tabs {
                height: 58px;
                padding-left: 24px;
                gap: 36px;
                padding-bottom: 12px;
            }

            .tabs__link {
                font-size: 18px;
            }

            .content {
                padding-top: 32px;
            }

            .items {
                grid-template-columns: 1fr;
                padding: 0 24px;
            }

            .item-card,
            .item-card__image-wrap {
                width: 100%;
            }

            .item-card__image-wrap {
                height: auto;
                aspect-ratio: 1 / 1;
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
            @if (($tab ?? 'recommend') === 'mylist')
                <input type="hidden" name="tab" value="mylist">
            @endif

            <input
                class="header__search-input"
                type="text"
                name="keyword"
                value="{{ request('keyword') }}"
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

    @php
        $keyword = request('keyword');

        $recommendQuery = [];
        if ($keyword) {
            $recommendQuery['keyword'] = $keyword;
        }

        $mylistQuery = ['tab' => 'mylist'];
        if ($keyword) {
            $mylistQuery['keyword'] = $keyword;
        }

        $recommendUrl = url('/');
        if (!empty($recommendQuery)) {
            $recommendUrl .= '?' . http_build_query($recommendQuery);
        }

        $mylistUrl = url('/') . '?' . http_build_query($mylistQuery);
    @endphp

    <div class="tabs">
        <a
            class="tabs__link {{ ($tab ?? 'recommend') !== 'mylist' ? 'tabs__link--active' : '' }}"
            href="{{ $recommendUrl }}"
        >
            おすすめ
        </a>

        <a
            class="tabs__link {{ ($tab ?? 'recommend') === 'mylist' ? 'tabs__link--active' : '' }}"
            href="{{ $mylistUrl }}"
        >
            マイリスト
        </a>
    </div>

    <main class="content">
        @if ($items->isEmpty())
            <p class="empty-message">
                表示できる商品がありません。
            </p>
        @else
            <div class="items">
                @foreach ($items as $item)
                    <a class="item-card" href="{{ route('items.show', $item) }}">
                        <div class="item-card__image-wrap">
                            @if (\Illuminate\Support\Str::startsWith($item->image, ['http://', 'https://']))
                                <img
                                    class="item-card__image"
                                    src="{{ $item->image }}"
                                    alt="{{ $item->name }}"
                                >
                            @else
                                <img
                                    class="item-card__image"
                                    src="{{ asset('storage/' . $item->image) }}"
                                    alt="{{ $item->name }}"
                                >
                            @endif

                            @if ($item->is_sold)
                                <span class="item-card__sold">Sold</span>
                            @endif
                        </div>

                        <p class="item-card__name">
                            {{ $item->name }}
                        </p>
                    </a>
                @endforeach
            </div>
        @endif

        @guest
            @if (($tab ?? 'recommend') === 'mylist')
                <p class="login-message">
                    マイリストを確認するには
                    <a class="login-message__link" href="{{ url('/login') }}">ログイン</a>
                    してください。
                </p>
            @endif
        @endguest
    </main>
</body>
</html>