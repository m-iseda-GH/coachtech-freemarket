<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>購入手続き</title>
</head>
<body>
    {{-- ヘッダー --}}
    <header style="margin-bottom: 24px; display: flex; align-items: center; gap: 24px;">
        <a href="{{ url('/') }}">
            <img
                src="{{ asset('images/header-logo.png') }}"
                alt="COACHTECH"
                width="180"
            >
        </a>

        {{-- 商品一覧へのリンク --}}
        <a href="{{ url('/') }}">商品一覧</a>

        @auth
            {{-- ログイン中のメニュー --}}
            <a href="{{ route('mypage.index') }}">マイページ</a>
            <a href="{{ route('items.create') }}">出品</a>

            {{-- ログアウト処理 --}}
            <form action="{{ url('/logout') }}" method="POST" style="display: inline;">
                @csrf
                <button type="submit">ログアウト</button>
            </form>
        @else
            {{-- 未ログイン時のメニュー --}}
            <a href="{{ url('/login') }}">ログイン</a>
            <a href="{{ url('/register') }}">会員登録</a>
        @endauth
    </header>

    {{-- 商品詳細画面へ戻るリンク --}}
    <a href="{{ route('items.show', $item) }}">商品詳細へ戻る</a>

    <h1>購入手続き</h1>

    {{-- 成功メッセージ --}}
    @if (session('message'))
        <p style="color: green;">{{ session('message') }}</p>
    @endif

    {{-- エラーメッセージ --}}
    @if (session('error'))
        <p style="color: red;">{{ session('error') }}</p>
    @endif

    {{-- 支払い方法のバリデーションエラー --}}
    @error('payment_method')
        <p style="color: red;">{{ $message }}</p>
    @enderror

    {{-- 購入情報を送信 --}}
    <form action="{{ route('purchase.store', $item) }}" method="POST">
        @csrf

        {{-- 購入する商品情報 --}}
        <div style="display: flex; gap: 40px; align-items: flex-start;">
            <div>
                <div style="display: flex; gap: 16px; align-items: center;">
                    <img src="{{ $item->image }}" alt="{{ $item->name }}" width="160">

                    <div>
                        <h2>{{ $item->name }}</h2>
                        <p>¥{{ number_format($item->price) }}</p>
                    </div>
                </div>

                <hr>

                {{-- 支払い方法の選択 --}}
                <section>
                    <h2>支払い方法</h2>

                    <select name="payment_method" id="payment_method">
                        <option value="">選択してください</option>
                        <option value="convenience" {{ old('payment_method') === 'convenience' ? 'selected' : '' }}>
                            コンビニ払い
                        </option>
                        <option value="card" {{ old('payment_method') === 'card' ? 'selected' : '' }}>
                            カード払い
                        </option>
                    </select>
                </section>

                <hr>

                {{-- 現在の配送先住所 --}}
                <section>
                    <div style="display: flex; justify-content: space-between; align-items: center;">
                        <h2>配送先</h2>

                        <a href="{{ route('purchase.address.edit', $item) }}">
                            変更する
                        </a>
                    </div>

                    <p>〒{{ $shippingAddress['postal_code'] }}</p>
                    <p>{{ $shippingAddress['address'] }}</p>

                    {{-- 建物名がある場合だけ表示 --}}
                    @if ($shippingAddress['building'])
                        <p>{{ $shippingAddress['building'] }}</p>
                    @endif
                </section>
            </div>

            {{-- 購入内容の確認欄 --}}
            <aside style="border: 1px solid #ccc; padding: 24px; min-width: 260px;">
                <h2>購入内容</h2>

                <p>商品代金：¥{{ number_format($item->price) }}</p>

                <p>
                    支払い方法：
                    <span id="selected_payment">未選択</span>
                </p>

                <button type="submit">
                    購入する
                </button>
            </aside>
        </div>
    </form>

    <script>
        // 支払い方法の選択欄を取得
        const paymentSelect = document.getElementById('payment_method');

        // 購入内容欄の支払い方法表示部分を取得
        const selectedPayment = document.getElementById('selected_payment');

        // 選択された支払い方法を購入内容欄へ反映
        function updateSelectedPayment() {
            if (paymentSelect.value === 'convenience') {
                selectedPayment.textContent = 'コンビニ払い';
            } else if (paymentSelect.value === 'card') {
                selectedPayment.textContent = 'カード払い';
            } else {
                selectedPayment.textContent = '未選択';
            }
        }

        // 支払い方法が変更されたときに表示を更新
        paymentSelect.addEventListener('change', updateSelectedPayment);

        // 画面表示時に現在の選択内容を反映
        updateSelectedPayment();
    </script>
</body>
</html>