<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>商品出品</title>
</head>
<body>
    {{-- ヘッダー --}}
    <header style="margin-bottom: 24px; display: flex; align-items: center; gap: 24px;">
        {{-- ロゴ --}}
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

    <h1>商品の出品</h1>

    {{-- 成功メッセージ --}}
    @if (session('message'))
        <p style="color: green;">{{ session('message') }}</p>
    @endif

    {{-- エラーメッセージ --}}
    @if (session('error'))
        <p style="color: red;">{{ session('error') }}</p>
    @endif

    {{-- 出品フォーム --}}
    <form action="{{ route('items.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        {{-- 商品画像 --}}
        <div>
            <label for="image">商品画像</label><br>

            {{-- 画像プレビュー --}}
            <img
                id="image-preview"
                src=""
                alt="商品画像プレビュー"
                width="200"
                style="display: none; margin-bottom: 8px;"
            >

            <input
                type="file"
                id="image"
                name="image"
                accept="image/png, image/jpeg"
            >

            @error('image')
                <p style="color: red;">{{ $message }}</p>
            @enderror
        </div>

        {{-- カテゴリー --}}
        <div style="margin-top: 24px;">
            <p>カテゴリー</p>

            @foreach ($categories as $category)
                <label style="display: inline-block; margin-right: 12px;">
                    <input
                        type="checkbox"
                        name="category_ids[]"
                        value="{{ $category->id }}"
                        {{ in_array($category->id, old('category_ids', [])) ? 'checked' : '' }}
                    >
                    {{ $category->name }}
                </label>
            @endforeach

            @error('category_ids')
                <p style="color: red;">{{ $message }}</p>
            @enderror

            @error('category_ids.*')
                <p style="color: red;">{{ $message }}</p>
            @enderror
        </div>

        {{-- 商品の状態 --}}
        <div style="margin-top: 24px;">
            <label for="condition_id">商品の状態</label><br>

            <select id="condition_id" name="condition_id">
                <option value="">選択してください</option>

                @foreach ($conditions as $condition)
                    <option
                        value="{{ $condition->id }}"
                        {{ old('condition_id') == $condition->id ? 'selected' : '' }}
                    >
                        {{ $condition->name }}
                    </option>
                @endforeach
            </select>

            @error('condition_id')
                <p style="color: red;">{{ $message }}</p>
            @enderror
        </div>

        {{-- 商品名 --}}
        <div style="margin-top: 24px;">
            <label for="name">商品名</label><br>

            <input
                type="text"
                id="name"
                name="name"
                value="{{ old('name') }}"
            >

            @error('name')
                <p style="color: red;">{{ $message }}</p>
            @enderror
        </div>

        {{-- ブランド名 --}}
        <div style="margin-top: 24px;">
            <label for="brand_name">ブランド名</label><br>

            <input
                type="text"
                id="brand_name"
                name="brand_name"
                value="{{ old('brand_name') }}"
            >

            @error('brand_name')
                <p style="color: red;">{{ $message }}</p>
            @enderror
        </div>

        {{-- 商品の説明 --}}
        <div style="margin-top: 24px;">
            <label for="description">商品の説明</label><br>

            <textarea
                id="description"
                name="description"
                rows="5"
                cols="50"
            >{{ old('description') }}</textarea>

            @error('description')
                <p style="color: red;">{{ $message }}</p>
            @enderror
        </div>

        {{-- 販売価格 --}}
        <div style="margin-top: 24px;">
            <label for="price">販売価格</label><br>

            <input
                type="number"
                id="price"
                name="price"
                value="{{ old('price') }}"
                min="1"
            >

            @error('price')
                <p style="color: red;">{{ $message }}</p>
            @enderror
        </div>

        {{-- 送信ボタン --}}
        <div style="margin-top: 32px;">
            <button type="submit">出品する</button>
        </div>
    </form>

    {{-- 商品画像プレビュー用JavaScript --}}
    <script>
        const imageInput = document.getElementById('image');
        const imagePreview = document.getElementById('image-preview');

        imageInput.addEventListener('change', function () {
            const file = this.files[0];

            if (!file) {
                imagePreview.src = '';
                imagePreview.style.display = 'none';
                return;
            }

            const reader = new FileReader();

            reader.onload = function (event) {
                imagePreview.src = event.target.result;
                imagePreview.style.display = 'block';
            };

            reader.readAsDataURL(file);
        });
    </script>
</body>
</html>