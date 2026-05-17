<x-guest-layout>
    <div class="mb-8">
        <p class="text-sm font-semibold text-teal-700 dark:text-teal-300">Área segura</p>
        <h1 class="mt-2 text-3xl font-semibold text-slate-950 dark:text-white">Confirma tu contraseña</h1>
        <p class="mt-2 text-sm leading-6 text-slate-500 dark:text-slate-400">
            Necesitamos verificar tu identidad antes de continuar.
        </p>
    </div>

    <form method="POST" action="{{ route('password.confirm') }}" class="space-y-5">
        @csrf

        <div class="vet-field-group">
            <label for="password" class="vet-login-label">Contraseña</label>
            <div class="vet-login-input-wrap">
                <svg class="vet-login-input-icon" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true">
                    <path
                        d="M7.5 10.25V8a4.5 4.5 0 0 1 9 0v2.25h.25A2.25 2.25 0 0 1 19 12.5v5A2.25 2.25 0 0 1 16.75 19.75h-9.5A2.25 2.25 0 0 1 5 17.5v-5a2.25 2.25 0 0 1 2.25-2.25h.25ZM9 8v2.25h6V8a3 3 0 1 0-6 0Zm3.75 6a.75.75 0 0 0-1.5 0v2a.75.75 0 0 0 1.5 0v-2Z" />
                </svg>
                <input id="password" type="password" name="password" required autocomplete="current-password"
                    class="vet-login-input pr-12" placeholder="Tu contraseña">
                <button type="button" data-password-toggle="password" class="vet-password-toggle"
                    aria-label="Mostrar contraseña">
                    <svg class="h-5 w-5" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true">
                        <path
                            d="M12 5.5c5.1 0 8.55 4.55 9.54 6a.86.86 0 0 1 0 1c-.99 1.45-4.44 6-9.54 6s-8.55-4.55-9.54-6a.86.86 0 0 1 0-1c.99-1.45 4.44-6 9.54-6Zm0 10.5a4 4 0 1 0 0-8 4 4 0 0 0 0 8Zm0-1.5a2.5 2.5 0 1 1 0-5 2.5 2.5 0 0 1 0 5Z" />
                    </svg>
                </button>
            </div>
            <x-input-error :messages="$errors->get('password')" class="mt-2 text-sm text-rose-500 dark:text-rose-300" />
        </div>

        <button type="submit" class="vet-login-submit">
            Confirmar
        </button>
    </form>
</x-guest-layout>
