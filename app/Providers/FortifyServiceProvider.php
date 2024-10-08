<?php

namespace App\Providers;

use App\Actions\Fortify\CreateNewUser;
use App\Actions\Fortify\ResetUserPassword;
use App\Actions\Fortify\UpdateUserPassword;
use App\Actions\Fortify\UpdateUserProfileInformation;
use App\Models\User;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Str;
use Laravel\Fortify\Fortify;

class FortifyServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Fortify::createUsersUsing(CreateNewUser::class);
        Fortify::updateUserProfileInformationUsing(UpdateUserProfileInformation::class);
        Fortify::updateUserPasswordsUsing(UpdateUserPassword::class);
        Fortify::resetUserPasswordsUsing(ResetUserPassword::class);

        RateLimiter::for('login', function (Request $request) {
            $throttleKey = Str::transliterate(Str::lower($request->input(Fortify::username())).'|'.$request->ip());

            return Limit::perMinute(5)->by($throttleKey);
        });

        RateLimiter::for('two-factor', function (Request $request) {
            return Limit::perMinute(5)->by($request->session()->get('login.id'));
        });
        Fortify::authenticateUsing(function (Request $request) {
            $user = User::where('email', $request->email)->first();

            // Vérifiez si l'utilisateur existe et si le mot de passe est correct
            if ($user && Hash::check($request->password, $user->password)) {
                // Vérifiez si l'utilisateur a activé l'authentification à deux facteurs
                if ($user->two_factor_secret) {
                    // Si l'utilisateur a activé 2FA, retournez null pour déclencher le défi 2FA
                    return null;
                }
                // L'utilisateur peut se connecter directement si 2FA n'est pas activé
                return $user;
            }

            // Renvoie null si les informations d'identification ne sont pas valides
            return null;
        });

        Fortify::loginView(function (){
            return view('auth.login');
        });

        Fortify::registerView(function (){
            return view('auth.register');
        });


        Fortify::requestPasswordResetLinkView(function () {
            return view('auth.forgot-password');
        });

        Fortify::resetPasswordView(function (Request $request) {
            return view('auth.reset-password', ['request' => $request]);
        });


        Fortify::verifyEmailView(function (){
            return view('auth.verify-email');
        });
        Fortify::confirmPasswordView(function (){
            return view('auth.confirm-password');
        });

        //Two factor Fortify

        Fortify::twoFactorChallengeView(function (){
            return view('auth.two-factor-challenge');
        });


    }
}
