<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsurePasswordWasChanged
{
    public function handle(Request $request, Closure $next): Response
    {
        $user = $request->user();

        if (! config('vetcare.features.force_password_change') || ! $user?->must_change_password) {
            return $next($request);
        }

        if ($request->routeIs([
            'profile.edit',
            'password.update',
            'logout',
            'verification.*',
            'two-factor.*',
        ])) {
            return $next($request);
        }

        return redirect()
            ->route('profile.edit')
            ->with('warning', 'Debes cambiar tu contraseña antes de continuar.');
    }
}
