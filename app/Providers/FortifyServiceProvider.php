<?php

namespace App\Providers;

use App\Actions\Fortify\CreateNewUser;
use App\Actions\Fortify\ResetUserPassword;
use App\Models\Profile;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Str;
use Illuminate\Validation\Rules\Password;
use Inertia\Inertia;
use Laravel\Fortify\Features;
use Laravel\Fortify\Fortify;

class FortifyServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        $this->configureAuthentication();
        $this->configureActions();
        $this->configureViews();
        $this->configureRateLimiting();
    }

    private function configureAuthentication(): void
    {
        Fortify::authenticateUsing(function (Request $request) {
            $url = rtrim(config('services.supabase.url'), '/');
            $apiKey = config('services.supabase.anon_key');

            if (!$url || !$apiKey) {
                Log::error('Supabase configuration missing', [
                    'url_configured' => (bool) $url,
                    'api_key_configured' => (bool) $apiKey,
                ]);

                return null;
            }

            try {
                $response = Http::acceptJson()
                    ->withHeaders([
                        'apikey' => $apiKey,
                    ])
                    ->timeout(15)
                    ->post($url . '/auth/v1/token?grant_type=password', [
                        'email' => $request->input(Fortify::username()),
                        'password' => $request->input('password'),
                    ]);

                if (!$response->successful()) {
                    Log::error('Supabase login failed', [
                        'status' => $response->status(),
                        'body' => $response->json(),
                    ]);

                    return null;
                }

                $userId = $response->json('user.id');

                if (!$userId) {
                    Log::error('Supabase login returned no user ID');

                    return null;
                }

                $profile = Profile::query()->find($userId);

                Log::info('Supabase profile lookup', [
                    'user_id' => $userId,
                    'profile_found' => (bool) $profile,
                ]);

                if (!$profile) {
                    return null;
                }

                $profile->setAttribute(
                    'email',
                    (string) $request->input(Fortify::username())
                );

                return $profile;

            } catch (\Throwable $e) {
                Log::error('Supabase authentication exception', [
                    'message' => $e->getMessage(),
                ]);

                return null;
            }
        });
    }

    private function configureActions(): void
    {
        Fortify::resetUserPasswordsUsing(ResetUserPassword::class);
        Fortify::createUsersUsing(CreateNewUser::class);
    }

    private function configureViews(): void
    {
        Fortify::loginView(fn (Request $request) => Inertia::render('auth/Login', [
            'canResetPassword' => Features::enabled(Features::resetPasswords()),
            'status' => $request->session()->get('status'),
        ]));

        Fortify::resetPasswordView(fn (Request $request) => Inertia::render('auth/ResetPassword', [
            'email' => $request->email,
            'token' => $request->route('token'),
            'passwordRules' => Password::defaults()->toPasswordRulesString(),
        ]));

        Fortify::requestPasswordResetLinkView(fn (Request $request) => Inertia::render('auth/ForgotPassword', [
            'status' => $request->session()->get('status'),
        ]));

        Fortify::verifyEmailView(fn (Request $request) => Inertia::render('auth/VerifyEmail', [
            'status' => $request->session()->get('status'),
        ]));

        Fortify::registerView(fn () => Inertia::render('auth/Register', [
            'passwordRules' => Password::defaults()->toPasswordRulesString(),
        ]));

        Fortify::twoFactorChallengeView(fn () => Inertia::render('auth/TwoFactorChallenge'));

        Fortify::confirmPasswordView(fn () => Inertia::render('auth/ConfirmPassword'));
    }

    private function configureRateLimiting(): void
    {
        RateLimiter::for('two-factor', function (Request $request) {
            return Limit::perMinute(5)->by($request->session()->get('login.id'));
        });

        RateLimiter::for('login', function (Request $request) {
            $throttleKey = Str::transliterate(
                Str::lower($request->input(Fortify::username())) . '|' . $request->ip()
            );

            return Limit::perMinute(5)->by($throttleKey);
        });

        RateLimiter::for('passkeys', function (Request $request) {
            return Limit::perMinute(10)->by(
                ($request->input('credential.id') ?: $request->session()->getId()) . '|' . $request->ip()
            );
        });
    }
}
