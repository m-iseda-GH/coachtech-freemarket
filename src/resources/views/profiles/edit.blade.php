<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>プロフィール設定</title>
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

        <a href="{{ url('/') }}">商品一覧</a>

        @auth
            <a href="{{ route('mypage.index') }}">マイページ</a>
            <a href="{{ route('items.create') }}">出品</a>

            <form action="{{ url('/logout') }}" method="POST" style="display: inline;">
                @csrf
                <button type="submit">ログアウト</button>
            </form>
        @else
            <a href="{{ url('/login') }}">ログイン</a>
            <a href="{{ url('/register') }}">会員登録</a>
        @endauth
    </header>

    <h1>プロフィール設定</h1>

    {{-- 成功メッセージ --}}
    @if (session('message'))
        <p style="color: green;">{{ session('message') }}</p>
    @endif

    {{-- エラーメッセージ --}}
    @if (session('error'))
        <p style="color: red;">{{ session('error') }}</p>
    @endif

    {{-- プロフィール更新フォーム --}}
    <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
        @csrf

        {{-- プロフィール画像 --}}
        <div>
            <label for="profile_image">プロフィール画像</label><br>

            {{-- 現在画像ありの場合 --}}
            @if ($user->profile_image)
                <img
                    id="profile-image-preview"
                    src="{{ asset('storage/' . $user->profile_image) }}"
                    alt="{{ $user->name }}"
                    width="120"
                    height="120"
                    style="border-radius: 50%; object-fit: cover; display: block; margin-bottom: 8px;"
                >

                <div
                    id="profile-image-placeholder"
                    style="
                        width: 120px;
                        height: 120px;
                        border-radius: 50%;
                        background: #ddd;
                        margin-bottom: 8px;
                        display: none;
                    "
                ></div>
            @else
                {{-- 現在画像なしの場合 --}}
                <img
                    id="profile-image-preview"
                    src=""
                    alt="プロフィール画像プレビュー"
                    width="120"
                    height="120"
                    style="border-radius: 50%; object-fit: cover; display: none; margin-bottom: 8px;"
                >

                <div
                    id="profile-image-placeholder"
                    style="
                        width: 120px;
                        height: 120px;
                        border-radius: 50%;
                        background: #ddd;
                        margin-bottom: 8px;
                    "
                ></div>
            @endif

            <input
                type="file"
                id="profile_image"
                name="profile_image"
                accept="image/png, image/jpeg"
            >

            @error('profile_image')
                <p style="color: red;">{{ $message }}</p>
            @enderror

            {{-- プロフィール画像削除 --}}
            <div style="margin-top: 8px;">
                <label>
                    <input
                        type="checkbox"
                        id="remove_profile_image"
                        name="remove_profile_image"
                        value="1"
                    >
                    プロフィール画像を削除する
                </label>
            </div>

            @error('remove_profile_image')
                <p style="color: red;">{{ $message }}</p>
            @enderror
        </div>

        {{-- ユーザー名 --}}
        <div style="margin-top: 16px;">
            <label for="name">ユーザー名</label><br>

            <input
                type="text"
                id="name"
                name="name"
                value="{{ old('name', $user->name) }}"
            >

            @error('name')
                <p style="color: red;">{{ $message }}</p>
            @enderror
        </div>

        {{-- 郵便番号 --}}
        <div style="margin-top: 16px;">
            <label for="postal_code">郵便番号</label><br>

            <input
                type="text"
                id="postal_code"
                name="postal_code"
                value="{{ old('postal_code', $user->postal_code) }}"
                placeholder="123-4567"
            >

            @error('postal_code')
                <p style="color: red;">{{ $message }}</p>
            @enderror
        </div>

        {{-- 住所 --}}
        <div style="margin-top: 16px;">
            <label for="address">住所</label><br>

            <input
                type="text"
                id="address"
                name="address"
                value="{{ old('address', $user->address) }}"
            >

            @error('address')
                <p style="color: red;">{{ $message }}</p>
            @enderror
        </div>

        {{-- 建物名 --}}
        <div style="margin-top: 16px;">
            <label for="building">建物名</label><br>

            <input
                type="text"
                id="building"
                name="building"
                value="{{ old('building', $user->building) }}"
            >

            @error('building')
                <p style="color: red;">{{ $message }}</p>
            @enderror
        </div>

        {{-- 更新ボタン --}}
        <div style="margin-top: 24px;">
            <button type="submit">更新する</button>
        </div>
    </form>

    {{-- プロフィール画像プレビュー用JavaScript --}}
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

            // 新しい画像を選択した場合は、削除チェックを外す
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
                // 削除チェックを入れたら、プレビューを非表示にして灰色の丸を表示
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