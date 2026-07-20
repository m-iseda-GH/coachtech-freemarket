<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>メール認証</title>

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
        }

        .header__logo {
            width: 272px;
            display: block;
        }

        .verify {
            width: 900px;
            margin: 170px auto 0;
            text-align: center;
        }

        .verify__status {
            margin: 0 0 28px;
            color: green;
            font-size: 16px;
            font-weight: 700;
        }

        .verify__message {
            margin: 0 0 62px;
            font-size: 24px;
            font-weight: 700;
            line-height: 1.45;
        }

        .verify__button {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 257px;
            height: 69px;
            margin-bottom: 62px;
            border: 1px solid #000;
            border-radius: 10px;
            background: #d9d9d9;
            color: #000;
            font-size: 24px;
            font-weight: 700;
        }

        .verify__resend {
            border: none;
            background: none;
            color: #0073cc;
            font-size: 20px;
            text-decoration: underline;
        }

        @media screen and (max-width: 900px) {
            .header {
                height: auto;
                min-height: 62px;
                padding: 14px 18px;
            }

            .header__logo {
                width: 230px;
            }

            .verify {
                width: 100%;
                margin-top: 120px;
                padding: 0 24px;
            }

            .verify__message {
                font-size: 20px;
                line-height: 1.6;
            }

            .verify__button {
                width: 240px;
                height: 60px;
                font-size: 22px;
            }

            .verify__resend {
                font-size: 18px;
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
    </header>

    <main class="verify">
        @if (session('status') === 'verification-link-sent')
            <p class="verify__status">
                認証メールを再送しました。
            </p>
        @endif

        <p class="verify__message">
            登録していただいたメールアドレスに認証メールを送付しました。<br>
            メール認証を完了してください。
        </p>

        <a
            class="verify__button"
            href="http://localhost:8025"
            target="_blank"
            rel="noopener noreferrer"
        >
            認証はこちらから
        </a>

        <form action="{{ url('/email/verification-notification') }}" method="POST">
            @csrf

            <button class="verify__resend" type="submit">
                認証メールを再送する
            </button>
        </form>
    </main>
</body>
</html>