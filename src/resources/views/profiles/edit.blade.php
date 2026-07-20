<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>プロフィール設定</title>

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

        .profile-edit {
            width: 544px;
            margin: 38px auto 64px;
        }

        .profile-edit__title {
            margin: 0 0 37px;
            text-align: center;
            font-size: 29px;
            font-weight: 700;
        }

        .profile-image {
            display: flex;
            align-items: center;
            gap: 34px;
            margin-bottom: 58px;
        }

        .profile-image__preview {
            width: 120px;
            height: 120px;
            border-radius: 50%;
            object-fit: cover;
            display: block;
            background: #d9d9d9;
        }

        .profile-image__placeholder {
            width: 120px;
            height: 120px;
            border-radius: 50%;
            background: #d9d9d9;
        }

        .profile-image__input {
            display: none;
        }

        .profile-image__button {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 144px;
            height: 37px;
            border: 2px solid #ff5555;
            border-radius: 8px;
            color: #ff5555;
            background: #fff;
            font-size: 14px;
            font-weight: 700;
            cursor: pointer;
        }

        .profile-image__remove {
            margin-top: 10px;
            color: #666;
            font-size: 13px;
        }

        .profile-image__remove input {
            margin-right: 6px;
        }

        .form__group {
            margin-bottom: 27px;
        }

        .form__label {
            display: block;
            margin-bottom: 5px;
            font-size: 19px;
            font-weight: 700;
        }

        .form__input {
            width: 100%;
            height: 40px;
            padding: 0 11px;
            border: 1px solid #5f5f5f;
            border-radius: 4px;
            color: #555;
            font-size: 16px;
            font-weight: 700;
        }

        .form__input::placeholder {
            color: #777;
            opacity: 1;
        }

        .form__error {
            margin: 7px 0 0;
            color: #ff0000;
            font-size: 14px;
        }

        .message {
            margin: 0 0 20px;
            color: green;
            font-size: 15px;
        }

        .error-message {
            margin: 0 0 20px;
            color: red;
            font-size: 15px;
        }

        .profile-edit__button {
            width: 100%;
            height: 48px;
            margin-top: 19px;
            border: none;
            border-radius: 5px;
            background: #ff5555;
            color: #fff;
            font-size: 21px;
            font-weight: 700;
        }

        @media screen and (max-width: 900px) {
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

            .profile-edit {
                width: 100%;
                margin-top: 38px;
                padding: 0 24px;
            }

            .profile-edit__title {
                font-size: 29px;
            }

            .profile-image {
                justify-content: center;
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

            .profile-edit__title {
                font-size: 26px;
            }

            .profile-image {
                flex-direction: column;
                gap: 20px;
                margin-bottom: 46px;
            }

            .form__label {
                font-size: 18px;
            }

            .form__input {
                font-size: 16px;
            }

            .profile-edit__button {
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

    <main class="profile-edit">
        <h1 class="profile-edit__title">プロフィール設定</h1>

        @if (session('message'))
            <p class="message">{{ session('message') }}</p>
        @endif

        @if (session('error'))
            <p class="error-message">{{ session('error') }}</p>
        @endif

        <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="profile-image">
                <div>
                    @if ($user->profile_image)
                        <img
                            id="profile-image-preview"
                            class="profile-image__preview"
                            src="{{ asset('storage/' . $user->profile_image) }}"
                            alt="{{ $user->name }}"
                        >

                        <div
                            id="profile-image-placeholder"
                            class="profile-image__placeholder"
                            style="display: none;"
                        ></div>
                    @else
                        <img
                            id="profile-image-preview"
                            class="profile-image__preview"
                            src=""
                            alt="プロフィール画像プレビュー"
                            style="display: none;"
                        >

                        <div
                            id="profile-image-placeholder"
                            class="profile-image__placeholder"
                        ></div>
                    @endif
                </div>

                <div>
                    <label class="profile-image__button" for="profile_image">
                        画像を選択する
                    </label>

                    <input
                        class="profile-image__input"
                        type="file"
                        id="profile_image"
                        name="profile_image"
                        accept="image/png, image/jpeg"
                    >

                    @if ($user->profile_image)
                        <label class="profile-image__remove">
                            <input
                                type="checkbox"
                                id="remove_profile_image"
                                name="remove_profile_image"
                                value="1"
                            >
                            プロフィール画像を削除する
                        </label>
                    @else
                        <input
                            type="checkbox"
                            id="remove_profile_image"
                            name="remove_profile_image"
                            value="1"
                            style="display: none;"
                        >
                    @endif

                    @error('profile_image')
                        <p class="form__error">{{ $message }}</p>
                    @enderror

                    @error('remove_profile_image')
                        <p class="form__error">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div class="form__group">
                <label class="form__label" for="name">ユーザー名</label>

                <input
                    class="form__input"
                    type="text"
                    id="name"
                    name="name"
                    value="{{ old('name', $user->name) }}"
                >

                @error('name')
                    <p class="form__error">{{ $message }}</p>
                @enderror
            </div>

            <div class="form__group">
                <label class="form__label" for="postal_code">郵便番号</label>

                <input
                    class="form__input"
                    type="text"
                    id="postal_code"
                    name="postal_code"
                    value="{{ old('postal_code', $user->postal_code) }}"
                    placeholder="例：123-4567"
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
                    value="{{ old('address', $user->address) }}"
                    placeholder="例：東京都渋谷区テスト1-2-3"
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
                    value="{{ old('building', $user->building) }}"
                    placeholder="例：テストマンション101"
                >

                @error('building')
                    <p class="form__error">{{ $message }}</p>
                @enderror
            </div>

            <button class="profile-edit__button" type="submit">
                更新する
            </button>
        </form>
    </main>

    <script>
        const profileImageInput = document.getElementById('profile_image');
        const profileImagePreview = document.getElementById('profile-image-preview');
        const profileImagePlaceholder = document.getElementById('profile-image-placeholder');
        const removeProfileImageCheckbox = document.getElementById('remove_profile_image');

        profileImageInput.addEventListener('change', function () {
            const file = this.files[0];

            if (!file) {
                return;
            }

            removeProfileImageCheckbox.checked = false;

            const reader = new FileReader();

            reader.onload = function (event) {
                profileImagePreview.src = event.target.result;
                profileImagePreview.style.display = 'block';

                if (profileImagePlaceholder) {
                    profileImagePlaceholder.style.display = 'none';
                }
            };

            reader.readAsDataURL(file);
        });

        removeProfileImageCheckbox.addEventListener('change', function () {
            if (this.checked) {
                profileImageInput.value = '';
                profileImagePreview.src = '';
                profileImagePreview.style.display = 'none';

                if (profileImagePlaceholder) {
                    profileImagePlaceholder.style.display = 'block';
                }
            }
        });
    </script>
</body>
</html>