<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>購入手続き</title>

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

        button,
        select {
            font-family: inherit;
        }

        button {
            cursor: pointer;
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
            width: 111.111%;
            min-height: 111.111vh;
            transform: scale(0.9);
            transform-origin: top left;
        }

        .purchase {
            width: 1352px;
            margin: 92px auto 0;
        }

        .purchase__form {
            display: grid;
            grid-template-columns: 805px 440px;
            column-gap: 107px;
            align-items: flex-start;
        }

        .purchase-main {
            width: 805px;
        }

        .product {
            display: flex;
            align-items: flex-start;
            gap: 55px;
            padding-bottom: 52px;
            border-bottom: 1px solid #000;
        }

        .product__image {
            width: 178px;
            height: 178px;
            object-fit: cover;
            display: block;
            background: #d9d9d9;
        }

        .product__name {
            margin: 0 0 24px;
            font-size: 30px;
            font-weight: 700;
            line-height: 1.3;
        }

        .product__price {
            margin: 0;
            font-size: 32px;
            line-height: 1.2;
        }

        .purchase-section {
            border-bottom: 1px solid #000;
            padding: 30px 36px 56px;
        }

        .purchase-section__header {
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .purchase-section__title {
            margin: 0;
            font-size: 24px;
            font-weight: 700;
        }

        .purchase-section__change {
            color: #0073cc;
            font-size: 20px;
            text-decoration: none;
        }

        .payment-select-wrap {
            position: relative;
            width: 265px;
            height: 32px;
            margin-top: 42px;
            margin-left: 61px;
        }

        .payment-select-wrap::after {
            content: "▼";
            position: absolute;
            top: 50%;
            right: 10px;
            transform: translateY(-50%);
            color: #5f5f5f;
            font-size: 14px;
            pointer-events: none;
        }

        .payment-select {
            width: 100%;
            height: 100%;
            padding: 0 36px 0 10px;
            border: 1px solid #5f5f5f;
            border-radius: 3px;
            color: #5f5f5f;
            background: #fff;
            font-size: 16px;
            font-weight: 700;
            line-height: 32px;
            appearance: none;
            -webkit-appearance: none;
            -moz-appearance: none;
        }

        .payment-select:focus {
            outline: none;
            border-color: #5f5f5f;
        }

        .form-error {
            margin: 12px 0 0 61px;
            color: #ff0000;
            font-size: 15px;
        }

        .address {
            margin-top: 38px;
            margin-left: 62px;
            font-size: 20px;
            font-weight: 700;
            line-height: 1.8;
        }

        .address p {
            margin: 0;
        }

        .summary {
            width: 440px;
        }

        .summary-table {
            width: 100%;
            border: 1px solid #000;
            border-collapse: collapse;
        }

        .summary-table__row {
            height: 115px;
            border-bottom: 1px solid #000;
        }

        .summary-table__row:last-child {
            border-bottom: none;
        }

        .summary-table__label {
            width: 50%;
            text-align: center;
            font-size: 20px;
            font-weight: 400;
        }

        .summary-table__value {
            width: 50%;
            text-align: center;
            font-size: 28px;
            font-weight: 400;
        }

        .summary-table__payment {
            font-size: 24px;
        }

        .purchase-button {
            width: 100%;
            height: 60px;
            margin-top: 66px;
            border: none;
            border-radius: 5px;
            background: #ff5555;
            color: #fff;
            font-size: 26px;
            font-weight: 700;
        }

        .message {
            width: 1352px;
            margin: 0 auto 24px;
            color: green;
            font-size: 16px;
        }

        .error-message {
            width: 1352px;
            margin: 0 auto 24px;
            color: red;
            font-size: 16px;
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

            .purchase,
            .message,
            .error-message {
                width: 100%;
            }

            .purchase {
                margin-top: 40px;
                padding: 0 24px;
            }

            .purchase__form {
                display: block;
            }

            .purchase-main,
            .summary {
                width: 100%;
            }

            .summary {
                margin-top: 40px;
            }

            .product {
                gap: 24px;
            }

            .product__image {
                width: 140px;
                height: 140px;
            }

            .product__name {
                font-size: 24px;
            }

            .product__price {
                font-size: 26px;
            }

            .payment-select-wrap {
                margin-left: 0;
            }

            .form-error {
                margin-left: 0;
            }

            .address {
                margin-left: 0;
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

            .product {
                display: block;
            }

            .product__image {
                width: 100%;
                height: auto;
                aspect-ratio: 1 / 1;
                margin-bottom: 20px;
            }

            .purchase-section {
                padding: 28px 0 42px;
            }

            .summary-table__label {
                font-size: 17px;
            }

            .summary-table__value {
                font-size: 22px;
            }

            .summary-table__payment {
                font-size: 20px;
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
        @if (session('message'))
            <p class="message">{{ session('message') }}</p>
        @endif

        @if (session('error'))
            <p class="error-message">{{ session('error') }}</p>
        @endif

        <main class="purchase">
            <form
                class="purchase__form"
                action="{{ route('purchase.store', $item) }}"
                method="POST"
            >
                @csrf

                <div class="purchase-main">
                    <section class="product">
                        @if (\Illuminate\Support\Str::startsWith($item->image, ['http://', 'https://']))
                            <img
                                class="product__image"
                                src="{{ $item->image }}"
                                alt="{{ $item->name }}"
                            >
                        @else
                            <img
                                class="product__image"
                                src="{{ asset('storage/' . $item->image) }}"
                                alt="{{ $item->name }}"
                            >
                        @endif

                        <div>
                            <h1 class="product__name">{{ $item->name }}</h1>

                            <p class="product__price">
                                ¥ {{ number_format($item->price) }}
                            </p>
                        </div>
                    </section>

                    <section class="purchase-section">
                        <h2 class="purchase-section__title">支払い方法</h2>

                        <div class="payment-select-wrap">
                            <select
                                class="payment-select"
                                name="payment_method"
                                id="payment_method"
                            >
                                <option value="">選択してください</option>
                                <option value="convenience" {{ old('payment_method') === 'convenience' ? 'selected' : '' }}>
                                    コンビニ払い
                                </option>
                                <option value="card" {{ old('payment_method') === 'card' ? 'selected' : '' }}>
                                    カード払い
                                </option>
                            </select>
                        </div>

                        @error('payment_method')
                            <p class="form-error">{{ $message }}</p>
                        @enderror
                    </section>

                    <section class="purchase-section">
                        <div class="purchase-section__header">
                            <h2 class="purchase-section__title">配送先</h2>

                            <a
                                class="purchase-section__change"
                                href="{{ route('purchase.address.edit', $item) }}"
                            >
                                変更する
                            </a>
                        </div>

                        <div class="address">
                            <p>〒 {{ $shippingAddress['postal_code'] }}</p>
                            <p>{{ $shippingAddress['address'] }}</p>

                            @if ($shippingAddress['building'])
                                <p>{{ $shippingAddress['building'] }}</p>
                            @endif
                        </div>
                    </section>
                </div>

                <aside class="summary">
                    <table class="summary-table">
                        <tr class="summary-table__row">
                            <th class="summary-table__label">商品代金</th>
                            <td class="summary-table__value">
                                ¥ {{ number_format($item->price) }}
                            </td>
                        </tr>

                        <tr class="summary-table__row">
                            <th class="summary-table__label">支払い方法</th>
                            <td
                                class="summary-table__value summary-table__payment"
                                id="selected_payment"
                            >
                                未選択
                            </td>
                        </tr>
                    </table>

                    <button class="purchase-button" type="submit">
                        購入する
                    </button>
                </aside>
            </form>
        </main>

        <script>
            const paymentSelect = document.getElementById('payment_method');
            const selectedPayment = document.getElementById('selected_payment');

            function updateSelectedPayment() {
                if (paymentSelect.value === 'convenience') {
                    selectedPayment.textContent = 'コンビニ払い';
                } else if (paymentSelect.value === 'card') {
                    selectedPayment.textContent = 'カード払い';
                } else {
                    selectedPayment.textContent = '未選択';
                }
            }

            paymentSelect.addEventListener('change', updateSelectedPayment);

            updateSelectedPayment();
        </script>
    </div>
</body>
</html>