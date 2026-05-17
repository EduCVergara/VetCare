<x-guest-layout>
    <div class="mb-8">
        <p class="text-sm font-semibold text-teal-700 dark:text-teal-300">Doble factor</p>
        <h1 class="mt-2 text-3xl font-semibold text-slate-950 dark:text-white">Confirma tu acceso</h1>
        <p class="mt-2 text-sm leading-6 text-slate-500 dark:text-slate-400">
            Ingresa el código de 6 dígitos que enviamos a tu correo.
        </p>
    </div>

    @if (session('status') === 'two-factor-code-sent')
        <div class="vet-login-alert vet-login-alert-success">
            Enviamos un nuevo código.
        </div>
    @endif

    <form method="POST" action="{{ route('two-factor.store') }}" class="space-y-5">
        @csrf

        <div class="vet-field-group">
            <label for="code" class="vet-login-label">Código de seguridad</label>
            <div class="vet-login-input-wrap">
                <svg class="vet-login-input-icon" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true">
                    <path d="M12 2 4.5 5.5v5.25c0 4.42 3.2 8.55 7.5 9.75 4.3-1.2 7.5-5.33 7.5-9.75V5.5L12 2Zm.75 12.25a.75.75 0 0 1-1.5 0v-3.5a.75.75 0 0 1 1.5 0v3.5Zm0-5.75a.75.75 0 0 1-1.5 0V7.75a.75.75 0 0 1 1.5 0v.75Z" />
                </svg>
                <input id="code" type="text" name="code" required autofocus inputmode="numeric" autocomplete="one-time-code"
                    maxlength="6" class="vet-login-input pl-12 tracking-[0.35em]" placeholder="000000">
            </div>
            <x-input-error :messages="$errors->get('code')" class="mt-2 text-sm text-rose-500 dark:text-rose-300" />
        </div>

        <button type="submit" class="vet-login-submit">
            Verificar código
        </button>
    </form>

    <div class="mt-3 flex items-center justify-between gap-3">
        <form method="POST" action="{{ route('two-factor.resend') }}">
            @csrf
            <button type="submit"
                class="text-sm font-semibold text-teal-700 transition hover:text-teal-600 dark:text-teal-300 dark:hover:text-teal-200">
                Reenviar código
            </button>
        </form>

        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit"
                class="text-sm font-semibold text-slate-500 transition hover:text-rose-500 dark:text-slate-400 dark:hover:text-rose-300">
                Cerrar sesión
            </button>
        </form>
    </div>
</x-guest-layout>
