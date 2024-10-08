<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class Verify2FAMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = Auth::user();

        // Si l'utilisateur a activé 2FA mais n'a pas encore confirmé
        if ($user && $user->two_factor_secret && !$user->two_factor_confirmed_at) {
            // Rediriger vers la page de confirmation de l'authentification 2FA
            return redirect()->route('two-factor.login');
        }

        return $next($request);
    }
}
