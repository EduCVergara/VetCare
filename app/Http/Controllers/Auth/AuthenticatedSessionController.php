<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Notifications\TwoFactorCodeNotification;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        $request->authenticate();

        $request->session()->regenerate();
        $request->session()->forget('two_factor_confirmed');

        if (config('vetcare.features.two_factor_auth') && $request->user()->two_factor_enabled) {
            $this->sendTwoFactorCode($request);

            return redirect()->route('two-factor.challenge');
        }

        return redirect()->intended(route('dashboard', absolute: false));
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }

    private function sendTwoFactorCode(Request $request): void
    {
        $code = (string) random_int(100000, 999999);
        $minutes = (int) config('vetcare.two_factor.code_expires_minutes', 10);

        Cache::put('two_factor_code:user:'.$request->user()->id, [
            'code' => Hash::make($code),
        ], now()->addMinutes($minutes));

        $request->user()->notify(new TwoFactorCodeNotification($code, $minutes));
    }
}
