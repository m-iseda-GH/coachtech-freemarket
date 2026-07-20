<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ログイン</title>

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

        .login {
            width: 100%;
            padding-top: 88px;
            padding-bottom: 30px;
        }

        .login__inner {
            width: 650px;
            margin: 0 auto;
        }

        .login__title {
            margin: 0 0 56px;
            text-align: center;
            font-size: 34px;
            font-weight: 700;
        }

        .form__group {
            margin-bottom: 30px;
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

        .login__button {
            width: 100%;
            height: 58px;
            margin-top: 48px;
            border: none;
            border-radius: 5px;
            background: #ff5555;
            color: #fff;
            font-size: 24px;
            font-weight: 700;
            cursor: pointer;
        }

        .login__button:hover {
            opacity: 0.85;
        }

        .login__link {
            margin-top: 24px;
            text-align: center;
        }

        .login__link a {
            color: #0073cc;
            font-size: 17px;
            text-decoration: none;
        }

        .login__link a:hover {
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

            .login {
                padding: 60px 20px 24px;
            }

            .login__inner {
                width: 100%;
            }

            .login__title {
                margin-bottom: 46px;
                font-size: 30px;
            }

            .form__group {
                margin-bottom: 24px;
            }

            .form__label {
                font-size: 20px;
            }

            .form__input {
                height: 48px;
                font-size: 16px;
            }

            .login__button {
                height: 54px;
                margin-top: 38px;
                font-size: 22px;
            }

            .login__link a {
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

    <main class="login">
        <div class="login__inner">
            <h1 class="login__title">ログイン</h1>

            <form action="/login" method="POST">
                @csrf

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

                <button class="login__button" type="submit">
                    ログインする
                </button>
            </form>

            <p class="login__link">
                <a href="/register">会員登録はこちら</a>
            </p>
        </div>
    </main>
</body>
</html>