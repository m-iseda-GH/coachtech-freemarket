<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>マイページ</title>

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

        .profile {
            height: 270px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .profile__inner {
            width: 1060px;
            display: grid;
            grid-template-columns: 150px 1fr 310px;
            align-items: center;
            column-gap: 92px;
        }

        .profile__image,
        .profile__image-placeholder {
            width: 150px;
            height: 150px;
            border-radius: 50%;
            object-fit: cover;
            display: block;
            background: #d9d9d9;
        }

        .profile__name {
            margin: 0;
            font-size: 36px;
            font-weight: 700;
            line-height: 1.4;
        }

        .profile__edit {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 310px;
            height: 58px;
            border: 2px solid #ff5555;
            border-radius: 10px;
            color: #ff5555;
            background: #fff;
            font-size: 26px;
            font-weight: 700;
            text-decoration: none;
        }

        .tabs {
            height: 80px;
            border-bottom: 2px solid #5f5f5f;
            display: flex;
            align-items: flex-end;
            gap: 64px;
            padding-left: 142px;
            padding-bottom: 18px;
        }

        .tabs__link {
            color: #000;
            font-size: 24px;
            font-weight: 700;
        }

        .tabs__link--active {
            color: #ff0000;
        }

        .content {
            width: 100%;
            padding: 60px 0 40px;
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
            margin: 10px 0 4px;
            font-size: 22px;
            line-height: 1.4;
        }

        .item-card__price {
            margin: 0;
            font-size: 18px;
            line-height: 1.4;
        }

        .empty-message {
            width: 1365px;
            margin: 0 auto;
            font-size: 20px;
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

            .profile__inner {
                width: 100%;
                padding: 0 40px;
                grid-template-columns: 130px 1fr 260px;
                column-gap: 48px;
            }

            .profile__image,
            .profile__image-placeholder {
                width: 130px;
                height: 130px;
            }

            .profile__name {
                font-size: 32px;
            }

            .profile__edit {
                width: 260px;
                height: 54px;
                font-size: 22px;
            }

            .tabs {
                padding-left: 40px;
            }

            .items,
            .empty-message {
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
            .profile {
                height: auto;
                padding: 40px 24px;
            }

            .profile__inner {
                display: block;
                text-align: center;
                padding: 0;
            }

            .profile__image,
            .profile__image-placeholder {
                margin: 0 auto 24px;
            }

            .profile__name {
                margin-bottom: 24px;
                font-size: 28px;
            }

            .profile__edit {
                margin: 0 auto;
            }

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
            <input
                class="header__search-input"
                type="text"
                name="keyword"
                placeholder="なにをお探しですか？"
            >
        </form>

        <nav class="header__nav">
            <form action="{{ url('/logout') }}" method="POST">
                @csrf

                <button class="header__logout" type="submit">
                    ログアウト
                </button>
            </form>

            <a class="header__link" href="{{ route('mypage.index') }}">
                マイページ
            </a>

            <a class="header__sell" href="{{ route('items.create') }}">
                出品
            </a>
        </nav>
    </header>

    <section class="profile">
        <div class="profile__inner">
            @if (auth()->user()->profile_image)
                <img
                    class="profile__image"
                    src="{{ asset('storage/' . auth()->user()->profile_image) }}"
                    alt="{{ auth()->user()->name }}"
                >
            @else
                <div class="profile__image-placeholder"></div>
            @endif

            <h1 class="profile__name">
                {{ auth()->user()->name }}
            </h1>

            <a class="profile__edit" href="{{ route('profile.edit') }}">
                プロフィールを編集
            </a>
        </div>
    </section>

    <nav class="tabs">
        <a
            class="tabs__link {{ ($page ?? 'sell') !== 'buy' ? 'tabs__link--active' : '' }}"
            href="{{ route('mypage.index', ['page' => 'sell']) }}"
        >
            出品した商品
        </a>

        <a
            class="tabs__link {{ ($page ?? 'sell') === 'buy' ? 'tabs__link--active' : '' }}"
            href="{{ route('mypage.index', ['page' => 'buy']) }}"
        >
            購入した商品
        </a>
    </nav>

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

                        <p class="item-card__price">
                            ¥{{ number_format($item->price) }}
                        </p>
                    </a>
                @endforeach
            </div>
        @endif
    </main>
</body>
</html>