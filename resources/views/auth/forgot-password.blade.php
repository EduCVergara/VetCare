<x-guest-layout>
    <div class="mb-8">
        <p class="text-sm font-semibold text-teal-700 dark:text-teal-300">Recuperación</p>
        <h1 class="mt-2 text-3xl font-semibold text-slate-950 dark:text-white">Restablece tu contraseña</h1>
        <p class="mt-2 text-sm leading-6 text-slate-500 dark:text-slate-400">
            Ingresa tu correo y te enviaremos un enlace para crear una nueva.
        </p>
    </div>

    <x-auth-session-status class="vet-login-alert vet-login-alert-success" :status="session('status')" />

    <form method="POST" action="{{ route('password.email') }}" class="space-y-5">
        @csrf

        <div class="vet-field-group">
            <label for="email" class="vet-login-label">Correo electrónico</label>
            <div class="vet-login-input-wrap">
                <svg class="vet-login-input-icon" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true">
                    <path
                        d="M4.5 5.25h15A2.25 2.25 0 0 1 21.75 7.5v9a2.25 2.25 0 0 1-2.25 2.25h-15A2.25 2.25 0 0 1 2.25 16.5v-9A2.25 2.25 0 0 1 4.5 5.25Zm0 1.5a.75.75 0 0 0-.75.75v.33l8.25 4.95 8.25-4.95V7.5a.75.75 0 0 0-.75-.75h-15Zm15.75 2.83-7.86 4.72a.75.75 0 0 1-.78 0L3.75 9.58v6.92c0 .41.34.75.75.75h15c.41 0 .75-.34.75-.75V9.58Z" />
                </svg>
                <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus
                    autocomplete="username" class="vet-login-input dark:[color-scheme:dark]"
                    placeholder="nombre@vetcare.cl">
            </div>
            <x-input-error :messages="$errors->get('email')" class="mt-2 text-sm text-rose-500 dark:text-rose-300" />
        </div>

        <div class="flex items-center justify-between gap-4 pt-1">
            <a href="{{ route('login') }}"
                class="text-sm font-semibold text-slate-500 transition hover:text-teal-700 dark:text-slate-400 dark:hover:text-teal-200">
                Volver
            </a>

            <button type="submit" class="vet-login-submit w-auto px-5">
                Enviar enlace
            </button>
        </div>
    </form>
</x-guest-layout>
