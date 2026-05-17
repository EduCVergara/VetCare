<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>VetCare - Iniciar sesión</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body
    class="vet-login-shell min-h-screen overflow-x-hidden bg-[#f6f8f4] text-slate-950 transition-colors duration-500 dark:bg-[#071014] dark:text-white">
    <main class="relative min-h-screen px-4 py-5 sm:px-6 lg:px-8">
        <div class="vet-login-backdrop" aria-hidden="true"></div>

        <div
            class="relative mx-auto grid min-h-[calc(100vh-2.5rem)] w-full max-w-6xl items-center gap-6 lg:grid-cols-[1fr_440px]">
            <section
                class="vet-login-story order-2 hidden overflow-hidden rounded-[28px] border border-white/70 bg-white/60 p-8 shadow-2xl shadow-teal-900/10 backdrop-blur-xl dark:border-white/10 dark:bg-white/[0.06] dark:shadow-black/30 lg:block">
                <div class="flex items-center justify-between">
                    <div class="flex items-center gap-3">
                        <div class="vet-brand-mark">
                            <x-icon.paw class="h-6 w-6" />
                        </div>
                        <div>
                            <p class="text-sm font-semibold text-slate-900 dark:text-white">VetCare</p>
                            <p class="text-xs text-slate-500 dark:text-slate-400">UI 2.0</p>
                        </div>
                    </div>

                    <button type="button" data-theme-toggle class="vet-theme-button" aria-label="Cambiar tema">
                        <svg class="h-4 w-4 dark:hidden" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true">
                            <path
                                d="M12 18a6 6 0 1 0 0-12 6 6 0 0 0 0 12Zm0 4a1 1 0 0 1-1-1v-1a1 1 0 1 1 2 0v1a1 1 0 0 1-1 1Zm0-18a1 1 0 0 1-1-1V2a1 1 0 1 1 2 0v1a1 1 0 0 1-1 1Zm10 8a1 1 0 0 1-1 1h-1a1 1 0 1 1 0-2h1a1 1 0 0 1 1 1ZM4 12a1 1 0 0 1-1 1H2a1 1 0 1 1 0-2h1a1 1 0 0 1 1 1Zm14.95 6.36a1 1 0 0 1-1.41 0l-.71-.71a1 1 0 0 1 1.41-1.41l.71.71a1 1 0 0 1 0 1.41ZM7.17 6.76A1 1 0 0 1 5.76 6.76l-.71-.71a1 1 0 0 1 1.41-1.41l.71.71a1 1 0 0 1 0 1.41Zm11.78-1.71a1 1 0 0 1 0 1.41l-.71.71a1 1 0 0 1-1.41-1.41l.71-.71a1 1 0 0 1 1.41 0ZM7.17 17.66l-.71.71a1 1 0 0 1-1.41-1.41l.71-.71a1 1 0 0 1 1.41 1.41Z" />
                        </svg>
                        <svg class="hidden h-4 w-4 dark:block" viewBox="0 0 24 24" fill="currentColor"
                            aria-hidden="true">
                            <path
                                d="M21 14.6A8.5 8.5 0 0 1 9.4 3a.75.75 0 0 0-.82-.99 10.25 10.25 0 1 0 13.41 13.41.75.75 0 0 0-.99-.82Z" />
                        </svg>
                    </button>
                </div>

                <div class="mt-20 max-w-xl">
                    <p
                        class="mb-4 inline-flex rounded-full border border-emerald-200 bg-emerald-50 px-3 py-1 text-xs font-semibold text-emerald-700 dark:border-emerald-400/20 dark:bg-emerald-400/10 dark:text-emerald-200">
                        Acceso clínico más claro y rápido
                    </p>
                    <h1 class="text-5xl font-semibold leading-tight text-slate-950 dark:text-white">
                        Tu jornada veterinaria empieza con calma.
                    </h1>
                    <p class="mt-5 max-w-lg text-base leading-7 text-slate-600 dark:text-slate-300">
                        Un acceso renovado para probar una interfaz más expresiva, con mejor contraste, estados de foco
                        visibles y animaciones suaves.
                    </p>
                </div>

                <div class="mt-16 grid grid-cols-3 gap-3">
                    <div class="vet-login-metric">
                        <span>24h</span>
                        <p>Agenda activa</p>
                    </div>
                    <div class="vet-login-metric">
                        <span>UX</span>
                        <p>Más fluida</p>
                    </div>
                    <div class="vet-login-metric">
                        <span>Dark</span>
                        <p>Modo nativo</p>
                    </div>
                </div>
            </section>

            <section
                class="vet-login-panel order-1 mx-auto w-full max-w-[440px] rounded-[28px] border border-white/75 bg-white/85 p-5 shadow-2xl shadow-teal-900/10 backdrop-blur-xl dark:border-white/10 dark:bg-slate-800/20 dark:shadow-black/40 sm:p-7 lg:order-2">
                <div class="mb-7 flex items-center justify-between lg:hidden">
                    <div class="flex items-center gap-3">
                        <div class="vet-brand-mark">
                            <svg class="h-7 w-7" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true">
                                <path
                                    d="M9.25 6.5a2 2 0 1 1-4 0 2 2 0 0 1 4 0Zm9.5 0a2 2 0 1 1-4 0 2 2 0 0 1 4 0ZM6.75 11.25a1.9 1.9 0 1 1-3.8 0 1.9 1.9 0 0 1 3.8 0Zm14.3 0a1.9 1.9 0 1 1-3.8 0 1.9 1.9 0 0 1 3.8 0ZM12 10.25c2.32 0 5.25 2.74 5.25 5.25 0 1.62-1.18 2.75-2.69 2.75-.9 0-1.49-.33-2.01-.62-.24-.13-.45-.25-.55-.25s-.31.12-.55.25c-.52.29-1.11.62-2.01.62-1.51 0-2.69-1.13-2.69-2.75 0-2.51 2.93-5.25 5.25-5.25Z" />
                            </svg>
                        </div>
                        <div>
                            <p class="text-sm font-semibold text-slate-900 dark:text-white">VetCare</p>
                            <p class="text-xs text-slate-500 dark:text-slate-400">Nueva UI experimental</p>
                        </div>
                    </div>

                    <button type="button" data-theme-toggle class="vet-theme-button" aria-label="Cambiar tema">
                        <svg class="h-4 w-4 dark:hidden" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true">
                            <path
                                d="M12 18a6 6 0 1 0 0-12 6 6 0 0 0 0 12Zm0 4a1 1 0 0 1-1-1v-1a1 1 0 1 1 2 0v1a1 1 0 0 1-1 1Zm0-18a1 1 0 0 1-1-1V2a1 1 0 1 1 2 0v1a1 1 0 0 1-1 1Zm10 8a1 1 0 0 1-1 1h-1a1 1 0 1 1 0-2h1a1 1 0 0 1 1 1ZM4 12a1 1 0 0 1-1 1H2a1 1 0 1 1 0-2h1a1 1 0 0 1 1 1Zm14.95 6.36a1 1 0 0 1-1.41 0l-.71-.71a1 1 0 0 1 1.41-1.41l.71.71a1 1 0 0 1 0 1.41ZM7.17 6.76A1 1 0 0 1 5.76 6.76l-.71-.71a1 1 0 0 1 1.41-1.41l.71.71a1 1 0 0 1 0 1.41Zm11.78-1.71a1 1 0 0 1 0 1.41l-.71.71a1 1 0 0 1-1.41-1.41l.71-.71a1 1 0 0 1 1.41 0ZM7.17 17.66l-.71.71a1 1 0 0 1-1.41-1.41l.71-.71a1 1 0 0 1 1.41 1.41Z" />
                        </svg>
                        <svg class="hidden h-4 w-4 dark:block" viewBox="0 0 24 24" fill="currentColor"
                            aria-hidden="true">
                            <path
                                d="M21 14.6A8.5 8.5 0 0 1 9.4 3a.75.75 0 0 0-.82-.99 10.25 10.25 0 1 0 13.41 13.41.75.75 0 0 0-.99-.82Z" />
                        </svg>
                    </button>
                </div>

                <div class="mb-8">
                    <p class="text-sm font-semibold text-teal-700 dark:text-teal-300">Bienvenido de vuelta</p>
                    <h2 class="mt-2 text-3xl font-semibold text-slate-950 dark:text-white">Inicia sesión</h2>
                    <p class="mt-2 text-sm leading-6 text-slate-500 dark:text-slate-400">
                        Entra a tu panel para continuar con pacientes, citas y seguimiento clínico.
                    </p>
                </div>

                @if(session('status'))
                    <div class="vet-login-alert vet-login-alert-success">
                        {{ session('status') }}
                    </div>
                @endif

                @if($errors->any())
                    <div class="vet-login-alert vet-login-alert-danger">
                        {{ $errors->first() }}
                    </div>
                @endif

                <form method="POST" action="{{ route('login') }}" class="space-y-5">
                    @csrf

                    <div class="vet-field-group">
                        <label for="email" class="vet-login-label">Correo electrónico</label>
                        <div class="vet-login-input-wrap">
                            <svg class="vet-login-input-icon" viewBox="0 0 24 24" fill="currentColor"
                                aria-hidden="true">
                                <path
                                    d="M4.5 5.25h15A2.25 2.25 0 0 1 21.75 7.5v9a2.25 2.25 0 0 1-2.25 2.25h-15A2.25 2.25 0 0 1 2.25 16.5v-9A2.25 2.25 0 0 1 4.5 5.25Zm0 1.5a.75.75 0 0 0-.75.75v.33l8.25 4.95 8.25-4.95V7.5a.75.75 0 0 0-.75-.75h-15Zm15.75 2.83-7.86 4.72a.75.75 0 0 1-.78 0L3.75 9.58v6.92c0 .41.34.75.75.75h15c.41 0 .75-.34.75-.75V9.58Z" />
                            </svg>
                            <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus
                                autocomplete="username" class="vet-login-input dark:[color-scheme:dark]"
                                placeholder="nombre@vetcare.cl">
                        </div>
                    </div>

                    <div class="vet-field-group">
                        <div class="flex items-center justify-between gap-3">
                            <label for="password" class="vet-login-label">Contraseña</label>
                            @if(Route::has('password.request'))
                                <a href="{{ route('password.request') }}"
                                    class="text-xs font-semibold text-teal-700 transition hover:text-teal-600 dark:text-teal-300 dark:hover:text-teal-200">
                                    ¿La olvidaste?
                                </a>
                            @endif
                        </div>
                        <div class="vet-login-input-wrap">
                            <svg class="vet-login-input-icon" viewBox="0 0 24 24" fill="currentColor"
                                aria-hidden="true">
                                <path
                                    d="M7.5 10.25V8a4.5 4.5 0 0 1 9 0v2.25h.25A2.25 2.25 0 0 1 19 12.5v5A2.25 2.25 0 0 1 16.75 19.75h-9.5A2.25 2.25 0 0 1 5 17.5v-5a2.25 2.25 0 0 1 2.25-2.25h.25ZM9 8v2.25h6V8a3 3 0 1 0-6 0Zm3.75 6a.75.75 0 0 0-1.5 0v2a.75.75 0 0 0 1.5 0v-2Z" />
                            </svg>
                            <input id="password" type="password" name="password" required
                                autocomplete="current-password" class="vet-login-input pr-12"
                                placeholder="Tu clave segura">
                            <button type="button" data-password-toggle="password" class="vet-password-toggle"
                                aria-label="Mostrar contraseña">
                                <svg class="h-5 w-5" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true">
                                    <path
                                        d="M12 5.5c5.1 0 8.55 4.55 9.54 6a.86.86 0 0 1 0 1c-.99 1.45-4.44 6-9.54 6s-8.55-4.55-9.54-6a.86.86 0 0 1 0-1c.99-1.45 4.44-6 9.54-6Zm0 10.5a4 4 0 1 0 0-8 4 4 0 0 0 0 8Zm0-1.5a2.5 2.5 0 1 1 0-5 2.5 2.5 0 0 1 0 5Z" />
                                </svg>
                            </button>
                        </div>
                    </div>

                    <div class="flex items-center justify-between gap-4">
                        <label for="remember"
                            class="flex cursor-pointer items-center gap-2 text-sm text-slate-600 dark:text-slate-300">
                            <input type="checkbox" name="remember" id="remember"
                                class="h-4 w-4 rounded border-slate-300 text-teal-600 shadow-sm focus:ring-teal-500 dark:border-slate-600 dark:bg-slate-900 dark:focus:ring-teal-400">
                            Recordarme
                        </label>
                        <span class="hidden text-xs text-slate-400 dark:text-slate-500 sm:inline">Acceso privado</span>
                    </div>

                    <button type="submit" class="vet-login-submit group">
                        <span>Entrar al panel</span>
                        <svg class="h-4 w-4 transition-transform duration-300 group-hover:translate-x-1"
                            viewBox="0 0 24 24" fill="currentColor" aria-hidden="true">
                            <path
                                d="M13.47 4.47a.75.75 0 0 1 1.06 0l7 7a.75.75 0 0 1 0 1.06l-7 7a.75.75 0 1 1-1.06-1.06l5.72-5.72H3a.75.75 0 0 1 0-1.5h16.19l-5.72-5.72a.75.75 0 0 1 0-1.06Z" />
                        </svg>
                    </button>
                </form>

                <div
                    class="mt-7 rounded-2xl border border-slate-200/70 bg-slate-50/80 p-4 text-sm text-slate-500 dark:border-white/10 dark:bg-white/[0.04] dark:text-slate-400">
                    <div class="flex items-start gap-3">
                        <div
                            class="mt-2 h-1.5 w-2.5 rounded-full bg-emerald-400 shadow-[0_0_0_5px_rgba(52,211,153,0.14)]">
                        </div>
                        <p>Consejo: activa el modo oscuro desde el botón superior y prueba el contraste antes de
                            extender esta UI.</p>
                    </div>
                </div>
            </section>
        </div>
    </main>
</body>

</html>