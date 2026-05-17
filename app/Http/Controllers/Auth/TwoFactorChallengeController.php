<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Notifications\TwoFactorCodeNotification;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;

class TwoFactorChallengeController extends Controller
{
    public function show(Request $request): View|RedirectResponse
    {
        if (! config('vetcare.features.two_factor_auth') || ! $request->user()->two_factor_enabled) {
            return redirect()->intended(route('dashboard', absolute: false));
        }

        if (! $this->hasPendingCode($request)) {
            $this->sendCode($request);
        }

        return view('auth.two-factor-challenge');
    }

    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'code' => ['required', 'digits:6'],
        ]);

        $payload = Cache::get($this->cacheKey($request));

        if (! $payload || ! Hash::check($request->code, $payload['code'])) {
            return back()->withErrors(['code' => 'El código ingresado no es válido.']);
        }

        Cache::forget($this->cacheKey($request));
        $request->session()->put('two_factor_confirmed', true);

        return redirect()->intended(route('dashboard', absolute: false));
    }

    public function resend(Request $request): RedirectResponse
    {
        $this->sendCode($request);

        return back()->with('status', 'two-factor-code-sent');
    }

    private function sendCode(Request $request): void
    {
        $code = (string) random_int(100000, 999999);
        $minutes = (int) config('vetcare.two_factor.code_expires_minutes', 10);

        Cache::put($this->cacheKey($request), [
            'code' => Hash::make($code),
        ], now()->addMinutes($minutes));

        $request->user()->notify(new TwoFactorCodeNotification($code, $minutes));
    }

    private function hasPendingCode(Request $request): bool
    {
        return Cache::has($this->cacheKey($request));
    }

    private function cacheKey(Request $request): string
    {
        return 'two_factor_code:user:'.$request->user()->id;
    }
}
