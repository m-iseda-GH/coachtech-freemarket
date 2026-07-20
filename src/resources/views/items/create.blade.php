<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>商品出品</title>

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
        input,
        textarea,
        select {
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

        .sell {
            width: 680px;
            margin: 44px auto 80px;
        }

        .sell__title {
            margin: 0 0 34px;
            text-align: center;
            font-size: 36px;
            font-weight: 700;
        }

        .form__group {
            margin-bottom: 34px;
        }

        .form__label {
            display: block;
            margin-bottom: 8px;
            font-size: 20px;
            font-weight: 700;
        }

        .image-upload {
            position: relative;
            width: 100%;
            height: 135px;
            border: 1px dashed #5f5f5f;
            border-radius: 3px;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
            background: #fff;
        }

        .image-upload__input {
            display: none;
        }

        .image-upload__button {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            min-width: 150px;
            height: 38px;
            padding: 0 18px;
            border: 2px solid #ff5555;
            border-radius: 10px;
            color: #ff5555;
            background: #fff;
            font-size: 14px;
            font-weight: 700;
            z-index: 2;
        }

        .image-upload__preview {
            position: absolute;
            inset: 0;
            width: 100%;
            height: 100%;
            object-fit: contain;
            display: none;
            background: #f8f8f8;
        }

        .section-title {
            margin: 64px 0 26px;
            padding-bottom: 8px;
            border-bottom: 1px solid #5f5f5f;
            color: #5f5f5f;
            font-size: 28px;
            font-weight: 700;
        }

        .category-title {
            margin: 0 0 26px;
            font-size: 20px;
            font-weight: 700;
        }

        .category-list {
            display: flex;
            flex-wrap: wrap;
            gap: 18px 16px;
            margin-bottom: 46px;
            padding: 0 10px;
        }

        .category-checkbox {
            display: inline-block;
        }

        .category-checkbox__input {
            display: none;
        }

        .category-checkbox__text {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            min-width: 72px;
            height: 30px;
            padding: 0 18px;
            border: 1px solid #ff5555;
            border-radius: 20px;
            color: #ff5555;
            background: #fff;
            font-size: 14px;
            line-height: 1;
            cursor: pointer;
        }

        .category-checkbox__input:checked + .category-checkbox__text {
            color: #fff;
            background: #ff5555;
        }

        .select-wrap {
            position: relative;
            width: 100%;
        }

        .select-wrap::after {
            content: "▼";
            position: absolute;
            top: 50%;
            right: 14px;
            transform: translateY(-50%);
            color: #5f5f5f;
            font-size: 16px;
            pointer-events: none;
        }

        .form__select {
            width: 100%;
            height: 40px;
            padding: 0 42px 0 12px;
            border: 1px solid #5f5f5f;
            border-radius: 4px;
            color: #5f5f5f;
            background: #fff;
            font-size: 15px;
            font-weight: 700;
            appearance: none;
            -webkit-appearance: none;
            -moz-appearance: none;
        }

        .form__select:focus {
            outline: none;
            border-color: #5f5f5f;
        }

        .form__input {
            width: 100%;
            height: 40px;
            padding: 0 10px;
            border: 1px solid #5f5f5f;
            border-radius: 4px;
            font-size: 17px;
        }

        .form__textarea {
            width: 100%;
            height: 115px;
            padding: 10px;
            border: 1px solid #5f5f5f;
            border-radius: 4px;
            font-size: 17px;
            resize: vertical;
        }

        .price-wrap {
            position: relative;
        }

        .price-wrap__mark {
            position: absolute;
            top: 50%;
            left: 10px;
            transform: translateY(-50%);
            font-size: 20px;
            font-weight: 700;
        }

        .price-wrap .form__input {
            padding-left: 32px;
        }

        .form__error {
            margin: 8px 0 0;
            color: #ff0000;
            font-size: 15px;
        }

        .sell__button {
            width: 100%;
            height: 60px;
            margin-top: 56px;
            border: none;
            border-radius: 5px;
            background: #ff5555;
            color: #fff;
            font-size: 26px;
            font-weight: 700;
        }

        .message {
            margin: 0 0 24px;
            color: green;
            font-size: 16px;
        }

        .error-message {
            margin: 0 0 24px;
            color: red;
            font-size: 16px;
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

            .sell {
                width: 100%;
                margin-top: 42px;
                padding: 0 24px;
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

            .sell__title {
                font-size: 30px;
            }

            .section-title {
                font-size: 24px;
            }

            .category-list {
                gap: 14px 10px;
                padding: 0;
            }

            .category-checkbox__text {
                padding: 0 14px;
                font-size: 13px;
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

    <main class="sell">
        <h1 class="sell__title">商品の出品</h1>

        @if (session('message'))
            <p class="message">{{ session('message') }}</p>
        @endif

        @if (session('error'))
            <p class="error-message">{{ session('error') }}</p>
        @endif

        <form action="{{ route('items.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="form__group">
                <label class="form__label" for="image">商品画像</label>

                <div class="image-upload">
                    <img
                        id="image-preview"
                        class="image-upload__preview"
                        src=""
                        alt="商品画像プレビュー"
                    >

                    <label class="image-upload__button" for="image">
                        画像を選択する
                    </label>

                    <input
                        class="image-upload__input"
                        type="file"
                        id="image"
                        name="image"
                        accept="image/png, image/jpeg"
                    >
                </div>

                @error('image')
                    <p class="form__error">{{ $message }}</p>
                @enderror
            </div>

            <h2 class="section-title">商品の詳細</h2>

            <div class="form__group">
                <p class="category-title">カテゴリー</p>

                <div class="category-list">
                    @foreach ($categories as $category)
                        <label class="category-checkbox">
                            <input
                                class="category-checkbox__input"
                                type="checkbox"
                                name="category_ids[]"
                                value="{{ $category->id }}"
                                {{ in_array($category->id, old('category_ids', [])) ? 'checked' : '' }}
                            >

                            <span class="category-checkbox__text">
                                {{ $category->name }}
                            </span>
                        </label>
                    @endforeach
                </div>

                @error('category_ids')
                    <p class="form__error">{{ $message }}</p>
                @enderror

                @error('category_ids.*')
                    <p class="form__error">{{ $message }}</p>
                @enderror
            </div>

            <div class="form__group">
                <label class="form__label" for="condition_id">商品の状態</label>

                <div class="select-wrap">
                    <select class="form__select" id="condition_id" name="condition_id">
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
                </div>

                @error('condition_id')
                    <p class="form__error">{{ $message }}</p>
                @enderror
            </div>

            <h2 class="section-title">商品名と説明</h2>

            <div class="form__group">
                <label class="form__label" for="name">商品名</label>

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
                <label class="form__label" for="brand_name">ブランド名</label>

                <input
                    class="form__input"
                    type="text"
                    id="brand_name"
                    name="brand_name"
                    value="{{ old('brand_name') }}"
                >

                @error('brand_name')
                    <p class="form__error">{{ $message }}</p>
                @enderror
            </div>

            <div class="form__group">
                <label class="form__label" for="description">商品の説明</label>

                <textarea
                    class="form__textarea"
                    id="description"
                    name="description"
                >{{ old('description') }}</textarea>

                @error('description')
                    <p class="form__error">{{ $message }}</p>
                @enderror
            </div>

            <div class="form__group">
                <label class="form__label" for="price">販売価格</label>

                <div class="price-wrap">
                    <span class="price-wrap__mark">¥</span>

                    <input
                        class="form__input"
                        type="number"
                        id="price"
                        name="price"
                        value="{{ old('price') }}"
                        min="1"
                    >
                </div>

                @error('price')
                    <p class="form__error">{{ $message }}</p>
                @enderror
            </div>

            <button class="sell__button" type="submit">
                出品する
            </button>
        </form>
    </main>

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