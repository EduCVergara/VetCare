<x-guest-layout>
    <div class="mb-8">
        <p class="text-sm font-semibold text-teal-700 dark:text-teal-300">Nueva clave</p>
        <h1 class="mt-2 text-3xl font-semibold text-slate-950 dark:text-white">Crea tu contraseña</h1>
        <p class="mt-2 text-sm leading-6 text-slate-500 dark:text-slate-400">
            Usa una contraseña segura para proteger tu cuenta.
        </p>
    </div>

    <form method="POST" action="{{ route('password.store') }}" class="space-y-5">
        @csrf

        <input type="hidden" name="token" value="{{ $request->route('token') }}">

        <div class="vet-field-group">
            <label for="email" class="vet-login-label">Correo electrónico</label>
            <div class="vet-login-input-wrap">
                <svg class="vet-login-input-icon" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true">
                    <path
                        d="M4.5 5.25h15A2.25 2.25 0 0 1 21.75 7.5v9a2.25 2.25 0 0 1-2.25 2.25h-15A2.25 2.25 0 0 1 2.25 16.5v-9A2.25 2.25 0 0 1 4.5 5.25Zm0 1.5a.75.75 0 0 0-.75.75v.33l8.25 4.95 8.25-4.95V7.5a.75.75 0 0 0-.75-.75h-15Zm15.75 2.83-7.86 4.72a.75.75 0 0 1-.78 0L3.75 9.58v6.92c0 .41.34.75.75.75h15c.41 0 .75-.34.75-.75V9.58Z" />
                </svg>
                <input id="email" type="email" name="email" value="{{ old('email', $request->email) }}" required
                    autofocus autocomplete="username" class="vet-login-input dark:[color-scheme:dark]"
                    placeholder="nombre@vetcare.cl">
            </div>
            <x-input-error :messages="$errors->get('email')" class="mt-2 text-sm text-rose-500 dark:text-rose-300" />
        </div>

        <div class="vet-field-group">
            <label for="password" class="vet-login-label">Nueva contraseña</label>
            <div class="vet-login-input-wrap">
                <svg class="vet-login-input-icon" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true">
                    <path
                        d="M7.5 10.25V8a4.5 4.5 0 0 1 9 0v2.25h.25A2.25 2.25 0 0 1 19 12.5v5A2.25 2.25 0 0 1 16.75 19.75h-9.5A2.25 2.25 0 0 1 5 17.5v-5a2.25 2.25 0 0 1 2.25-2.25h.25ZM9 8v2.25h6V8a3 3 0 1 0-6 0Zm3.75 6a.75.75 0 0 0-1.5 0v2a.75.75 0 0 0 1.5 0v-2Z" />
                </svg>
                <input id="password" type="password" name="password" required autocomplete="new-password"
                    class="vet-login-input pr-12" placeholder="Mínimo 8 caracteres">
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

        <div class="vet-field-group">
            <label for="password_confirmation" class="vet-login-label">Confirmar contraseña</label>
            <div class="vet-login-input-wrap">
                <svg class="vet-login-input-icon" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true">
                    <path
                        d="M9.55 17.6 4.8 12.85l1.4-1.4 3.35 3.35 8.25-8.25 1.4 1.4-9.65 9.65Z" />
                </svg>
                <input id="password_confirmation" type="password" name="password_confirmation" required
                    autocomplete="new-password" class="vet-login-input pr-12" placeholder="Repite la contraseña">
                <button type="button" data-password-toggle="password_confirmation" class="vet-password-toggle"
                    aria-label="Mostrar contraseña">
                    <svg class="h-5 w-5" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true">
                        <path
                            d="M12 5.5c5.1 0 8.55 4.55 9.54 6a.86.86 0 0 1 0 1c-.99 1.45-4.44 6-9.54 6s-8.55-4.55-9.54-6a.86.86 0 0 1 0-1c.99-1.45 4.44-6 9.54-6Zm0 10.5a4 4 0 1 0 0-8 4 4 0 0 0 0 8Zm0-1.5a2.5 2.5 0 1 1 0-5 2.5 2.5 0 0 1 0 5Z" />
                    </svg>
                </button>
            </div>
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2 text-sm text-rose-500 dark:text-rose-300" />
        </div>

        <button type="submit" class="vet-login-submit">
            Guardar contraseña
        </button>
    </form>
</x-guest-layout>
