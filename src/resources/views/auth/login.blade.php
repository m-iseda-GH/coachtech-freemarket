<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>ログイン</title>
</head>
<body>
    <h1>ログイン</h1>

    @if ($errors->any())
        <div style="color: red;">
            @foreach ($errors->all() as $error)
                <p>{{ $error }}</p>
            @endforeach
        </div>
    @endif

    <form action="/login" method="POST">
        @csrf

        <div>
            <label for="email">メールアドレス</label><br>
            <input
                type="email"
                id="email"
                name="email"
                value="{{ old('email') }}"
            >
        </div>

        <div style="margin-top: 16px;">
            <label for="password">パスワード</label><br>
            <input
                type="password"
                id="password"
                name="password"
            >
        </div>

        <div style="margin-top: 24px;">
            <button type="submit">ログインする</button>
        </div>
    </form>

    <p style="margin-top: 24px;">
        <a href="/register">会員登録はこちら</a>
    </p>
</body>
</html>