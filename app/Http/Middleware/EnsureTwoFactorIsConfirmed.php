<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureTwoFactorIsConfirmed
{
    public function handle(Request $request, Closure $next): Response
    {
        if (
            ! config('vetcare.features.two_factor_auth')
            || ! $request->user()
            || ! $request->user()->two_factor_enabled
        ) {
            return $next($request);
        }

        if ($request->session()->get('two_factor_confirmed') === true) {
            return $next($request);
        }

        if ($request->routeIs([
            'two-factor.*',
            'logout',
            'verification.*',
        ])) {
            return $next($request);
        }

        return redirect()->route('two-factor.challenge');
    }
}
