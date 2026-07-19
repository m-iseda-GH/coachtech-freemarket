<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    // プロフィール編集画面を表示
    public function edit()
    {
        $user = Auth::user();

        return view('profiles.edit', compact('user'));
    }

    // プロフィール情報を更新
    public function update(ProfileRequest $request)
    {
        $user = Auth::user();

        $data = $request->only([
            'name',
            'postal_code',
            'address',
            'building',
        ]);

        // プロフィール画像を削除する場合
        if ($request->boolean('remove_profile_image')) {
            if ($user->profile_image) {
                Storage::disk('public')->delete($user->profile_image);
            }

            $data['profile_image'] = null;
        }
        // 新しいプロフィール画像を登録する場合
        elseif ($request->hasFile('profile_image')) {
            if ($user->profile_image) {
                Storage::disk('public')->delete($user->profile_image);
            }

            $data['profile_image'] = $request
                ->file('profile_image')
                ->store('profile_images', 'public');
        }

        $user->update($data);

        return redirect()
            ->route('profile.edit')
            ->with('message', 'プロフィールを更新しました');
    }
}
