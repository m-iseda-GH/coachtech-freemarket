<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>配送先住所変更</title>

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

        button,
        input {
            font-family: inherit;
        }

        button {
            cursor: pointer;
        }

        .header {
            width: 100%;
            height: 78px;
            background: #000;
            display: flex;
            align-items: center;
            padding-left: 24px;
            padding-right: 26px;
        }

        .header__logo-link {
            display: flex;
            align-items: center;
            flex-shrink: 0;
        }

        .header__logo {
            width: 340px;
            display: block;
        }

        .header__search {
            width: 620px;
            margin: 0 auto;
        }

        .header__search-input {
            width: 100%;
            height: 50px;
            padding: 0 30px;
            border: none;
            border-radius: 5px;
            color: #000;
            font-size: 24px;
            text-align: center;
        }

        .header__search-input::placeholder {
            color: #000;
            opacity: 1;
        }

        .header__nav {
            display: flex;
            align-items: center;
            gap: 34px;
            flex-shrink: 0;
        }

        .header__link,
        .header__logout {
            color: #fff;
            background: none;
            border: none;
            font-size: 24px;
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
            width: 100px;
            height: 50px;
            border-radius: 5px;
            background: #fff;
            color: #000;
            font-size: 24px;
            text-decoration: none;
        }

        .address-edit {
            width: 680px;
            margin: 48px auto 0;
        }

        .address-edit__title {
            margin: 0 0 92px;
            text-align: center;
            font-size: 36px;
            font-weight: 700;
        }

        .form__group {
            margin-bottom: 64px;
        }

        .form__label {
            display: block;
            margin-bottom: 8px;
            font-size: 24px;
            font-weight: 700;
        }

        .form__input {
            width: 100%;
            height: 46px;
            padding: 0 12px;
            border: 1px solid #5f5f5f;
            border-radius: 4px;
            font-size: 18px;
        }

        .form__error {
            margin: 8px 0 0;
            color: #ff0000;
            font-size: 15px;
        }

        .address-edit__button {
            width: 100%;
            height: 60px;
            margin-top: 46px;
            border: none;
            border-radius: 5px;
            background: #ff5555;
            color: #fff;
            font-size: 26px;
            font-weight: 700;
        }

        @media screen and (max-width: 1300px) {
            .header {
                gap: 22px;
            }

            .header__logo {
                width: 300px;
            }

            .header__search {
                width: 420px;
            }

            .header__search-input {
                font-size: 20px;
            }

            .header__nav {
                gap: 20px;
            }

            .header__link,
            .header__logout,
            .header__sell {
                font-size: 20px;
            }
        }

        @media screen and (max-width: 900px) {
            .header {
                height: auto;
                min-height: 78px;
                flex-wrap: wrap;
                padding: 16px 20px;
            }

            .header__logo {
                width: 250px;
            }

            .header__search {
                order: 3;
                width: 100%;
                margin-top: 14px;
            }

            .header__search-input {
                font-size: 20px;
            }

            .header__nav {
                margin-left: auto;
                gap: 20px;
            }

            .header__link,
            .header__logout {
                font-size: 18px;
            }

            .header__sell {
                width: 80px;
                height: 40px;
                font-size: 18px;
            }

            .address-edit {
                width: 100%;
                margin-top: 42px;
                padding: 0 24px;
            }

            .address-edit__title {
                margin-bottom: 56px;
                font-size: 32px;
            }
        }

        @media screen and (max-width: 600px) {
            .header__nav {
                width: 100%;
                justify-content: space-between;
                gap: 10px;
                margin-top: 14px;
            }

            .header__link,
            .header__logout,
            .header__sell {
                font-size: 16px;
            }

            .address-edit__title {
                font-size: 28px;
            }

            .form__group {
                margin-bottom: 42px;
            }

            .form__label {
                font-size: 21px;
            }

            .address-edit__button {
                font-size: 23px;
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

    <main class="address-edit">
        <h1 class="address-edit__title">住所の変更</h1>

        <form action="{{ route('purchase.address.update', $item) }}" method="POST">
            @csrf

            <div class="form__group">
                <label class="form__label" for="postal_code">郵便番号</label>

                <input
                    class="form__input"
                    type="text"
                    id="postal_code"
                    name="postal_code"
                    value="{{ old('postal_code', $shippingAddress['postal_code'] ?? '') }}"
                >

                @error('postal_code')
                    <p class="form__error">{{ $message }}</p>
                @enderror
            </div>

            <div class="form__group">
                <label class="form__label" for="address">住所</label>

                <input
                    class="form__input"
                    type="text"
                    id="address"
                    name="address"
                    value="{{ old('address', $shippingAddress['address'] ?? '') }}"
                >

                @error('address')
                    <p class="form__error">{{ $message }}</p>
                @enderror
            </div>

            <div class="form__group">
                <label class="form__label" for="building">建物名</label>

                <input
                    class="form__input"
                    type="text"
                    id="building"
                    name="building"
                    value="{{ old('building', $shippingAddress['building'] ?? '') }}"
                >

                @error('building')
                    <p class="form__error">{{ $message }}</p>
                @enderror
            </div>

            <button class="address-edit__button" type="submit">
                更新する
            </button>
        </form>
    </main>
</body>
</html>