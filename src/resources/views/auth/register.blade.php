<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>会員登録</title>

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

        .header {
            height: 78px;
            background: #000;
            display: flex;
            align-items: center;
            padding-left: 24px;
        }

        .header__logo {
            width: 340px;
            max-width: 80%;
        }

        .register {
            width: 100%;
            padding-top: 52px;
            padding-bottom: 30px;
        }

        .register__inner {
            width: 650px;
            margin: 0 auto;
        }

        .register__title {
            margin: 0 0 42px;
            text-align: center;
            font-size: 34px;
            font-weight: 700;
        }

        .form__group {
            margin-bottom: 22px;
        }

        .form__label {
            display: block;
            margin-bottom: 4px;
            font-size: 22px;
            font-weight: 700;
        }

        .form__input {
            width: 100%;
            height: 50px;
            padding: 0 12px;
            border: 1px solid #5f5f5f;
            border-radius: 4px;
            font-size: 18px;
        }

        .form__error {
            margin: 5px 0 0;
            color: #ff5555;
            font-size: 15px;
        }

        .register__button {
            width: 100%;
            height: 58px;
            margin-top: 34px;
            border: none;
            border-radius: 5px;
            background: #ff5555;
            color: #fff;
            font-size: 24px;
            font-weight: 700;
            cursor: pointer;
        }

        .register__button:hover {
            opacity: 0.85;
        }

        .register__link {
            margin-top: 24px;
            text-align: center;
        }

        .register__link a {
            color: #0073cc;
            font-size: 17px;
            text-decoration: none;
        }

        .register__link a:hover {
            text-decoration: underline;
        }

        @media screen and (max-width: 768px) {
            .header {
                height: 68px;
                padding-left: 16px;
            }

            .header__logo {
                width: 250px;
            }

            .register {
                padding: 42px 20px 24px;
            }

            .register__inner {
                width: 100%;
            }

            .register__title {
                margin-bottom: 34px;
                font-size: 30px;
            }

            .form__group {
                margin-bottom: 20px;
            }

            .form__label {
                font-size: 20px;
            }

            .form__input {
                height: 48px;
                font-size: 16px;
            }

            .register__button {
                height: 54px;
                margin-top: 28px;
                font-size: 22px;
            }

            .register__link a {
                font-size: 16px;
            }
        }
    </style>
</head>
<body>
    <header class="header">
        <a href="/">
            <img
                class="header__logo"
                src="{{ asset('images/header-logo.png') }}"
                alt="COACHTECH"
            >
        </a>
    </header>

    <main class="register">
        <div class="register__inner">
            <h1 class="register__title">会員登録</h1>

            <form action="/register" method="POST">
                @csrf

                <div class="form__group">
                    <label class="form__label" for="name">ユーザー名</label>
                    <input
                        class="form__input"
                        type="text"
                        id="name"
                        name="name"
                        value="{{ old('name') }}"
                    >

                    @error('name')
                        <p class="form__error">{{ $message }}</p>
                    @enderror
                </div>

                <div class="form__group">
                    <label class="form__label" for="email">メールアドレス</label>
                    <input
                        class="form__input"
                        type="email"
                        id="email"
                        name="email"
                        value="{{ old('email') }}"
                    >

                    @error('email')
                        <p class="form__error">{{ $message }}</p>
                    @enderror
                </div>

                <div class="form__group">
                    <label class="form__label" for="password">パスワード</label>
                    <input
                        class="form__input"
                        type="password"
                        id="password"
                        name="password"
                    >

                    @error('password')
                        <p class="form__error">{{ $message }}</p>
                    @enderror
                </div>

                <div class="form__group">
                    <label class="form__label" for="password_confirmation">確認用パスワード</label>
                    <input
                        class="form__input"
                        type="password"
                        id="password_confirmation"
                        name="password_confirmation"
                    >

                    @error('password_confirmation')
                        <p class="form__error">{{ $message }}</p>
                    @enderror
                </div>

                <button class="register__button" type="submit">
                    登録する
                </button>
            </form>

            <p class="register__link">
                <a href="/login">ログインはこちら</a>
            </p>
        </div>
    </main>
</body>
</html>