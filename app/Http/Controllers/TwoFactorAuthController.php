<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Fortify\Contracts\TwoFactorAuthenticationProvider;
use Endroid\QrCode\QrCode;
use Illuminate\Support\Str;

class TwoFactorAuthController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        return view('auth.two_factor');
        /*return view('auth.two-factor', [
            'secret' => $user->two_factor_secret,
            'qrCode' => $this->generateQrCode($user),
            'recoveryCodes' => $this->generateRecoveryCodes()
        ]);*/
    }

   /* private function generateQrCode($user)
    {
        $secret = $user->two_factor_secret ?: Str::random(10);
        $user->two_factor_secret = $secret;
        $user->save();

        $url = 'otpauth://totp/' . urlencode($user->email) . '?secret=' . $secret . '&issuer=' . urlencode(config('app.name'));

        $qrCode = new QrCode($url);
        return $qrCode->writeDataUri();
    }*/

   /* private function generateRecoveryCodes()
    {
        return collect(range(1, 8))->map(function () {
            return Str::random(10);
        });
    }

    public function store(Request $request)
    {
        $request->validate(['code' => 'required']);

        $user = Auth::user();

        if ($user->two_factor_secret && $user->twoFactorAuthentication()->verify($request->code)) {
            // Authentifier l'utilisateur
            return redirect()->intended('/dashboard');
        }

        return back()->withErrors(['code' => 'Le code est invalide.']);
    }*/
}

