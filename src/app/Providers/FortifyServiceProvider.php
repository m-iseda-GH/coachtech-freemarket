<?php

namespace App\Providers;

use App\Actions\Fortify\CreateNewUser;
use App\Actions\Fortify\ResetUserPassword;
use App\Actions\Fortify\UpdateUserPassword;
use App\Actions\Fortify\UpdateUserProfileInformation;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Str;
use Laravel\Fortify\Actions\RedirectIfTwoFactorAuthenticatable;
use Laravel\Fortify\Fortify;
use Laravel\Fortify\Contracts\RegisterResponse;
use Override;

class FortifyServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        // 会員登録後のリダイレクト先を設定
        $this->app->singleton(RegisterResponse::class, function () {
            return new class implements RegisterResponse {
                #[Override]
                public function toResponse($request)
                {
                    return redirect('/mypage/profile');
                }
            };
        });
    }

    // Fortifyの各種設定
    public function boot(): void
    {
        // Fortifyで使用する処理を登録
        Fortify::createUsersUsing(CreateNewUser::class);
        Fortify::updateUserProfileInformationUsing(UpdateUserProfileInformation::class);
        Fortify::updateUserPasswordsUsing(UpdateUserPassword::class);
        Fortify::resetUserPasswordsUsing(ResetUserPassword::class);
        Fortify::redirectUserForTwoFactorAuthenticationUsing(RedirectIfTwoFactorAuthenticatable::class);

        // 会員登録画面を設定
        Fortify::registerView(function () {
            return view('auth.register');
        });

        // ログイン画面を設定
        Fortify::loginView(function () {
            return view('auth.login');
        });

        // ログイン試行回数を制限
        RateLimiter::for('login', function (Request $request) {
            $throttleKey = Str::transliterate(Str::lower($request->input(Fortify::username())) . '|' . $request->ip());

            return Limit::perMinute(5)->by($throttleKey);
        });

        // 二段階認証の試行回数を制限
        RateLimiter::for('two-factor', function (Request $request) {
            return Limit::perMinute(5)->by($request->session()->get('login.id'));
        });
    }
}
