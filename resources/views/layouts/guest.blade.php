<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'VetCare') }}</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body
    class="vet-login-shell min-h-screen overflow-x-hidden bg-[#f6f8f4] text-slate-950 transition-colors duration-500 dark:bg-[#071014] dark:text-white">
    <main class="relative flex min-h-screen items-center justify-center px-4 py-6 sm:px-6">
        <div class="vet-login-backdrop" aria-hidden="true"></div>

        <section
            class="vet-login-panel relative w-full max-w-[460px] rounded-[28px] border border-white/75 bg-white/85 p-5 shadow-2xl shadow-teal-900/10 backdrop-blur-xl dark:border-white/10 dark:bg-slate-800/20 dark:shadow-black/40 sm:p-7">
            <div class="mb-8 flex items-center justify-between">
                <a href="{{ route('login') }}" class="flex items-center gap-3">
                    <div class="vet-brand-mark">
                        <x-icon.paw class="h-6 w-6" />
                    </div>
                    <div>
                        <p class="text-sm font-semibold text-slate-900 dark:text-white">VetCare</p>
                        <p class="text-xs text-slate-500 dark:text-slate-400">UI 2.0</p>
                    </div>
                </a>

                <button type="button" data-theme-toggle class="vet-theme-button" aria-label="Cambiar tema">
                    <svg class="h-4 w-4 dark:hidden" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true">
                        <path
                            d="M12 18a6 6 0 1 0 0-12 6 6 0 0 0 0 12Zm0 4a1 1 0 0 1-1-1v-1a1 1 0 1 1 2 0v1a1 1 0 0 1-1 1Zm0-18a1 1 0 0 1-1-1V2a1 1 0 1 1 2 0v1a1 1 0 0 1-1 1Zm10 8a1 1 0 0 1-1 1h-1a1 1 0 1 1 0-2h1a1 1 0 0 1 1 1ZM4 12a1 1 0 0 1-1 1H2a1 1 0 1 1 0-2h1a1 1 0 0 1 1 1Zm14.95 6.36a1 1 0 0 1-1.41 0l-.71-.71a1 1 0 0 1 1.41-1.41l.71.71a1 1 0 0 1 0 1.41ZM7.17 6.76A1 1 0 0 1 5.76 6.76l-.71-.71a1 1 0 0 1 1.41-1.41l.71.71a1 1 0 0 1 0 1.41Zm11.78-1.71a1 1 0 0 1 0 1.41l-.71.71a1 1 0 0 1-1.41-1.41l.71-.71a1 1 0 0 1 1.41 0ZM7.17 17.66l-.71.71a1 1 0 0 1-1.41-1.41l.71-.71a1 1 0 0 1 1.41 1.41Z" />
                    </svg>
                    <svg class="hidden h-4 w-4 dark:block" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true">
                        <path
                            d="M21 14.6A8.5 8.5 0 0 1 9.4 3a.75.75 0 0 0-.82-.99 10.25 10.25 0 1 0 13.41 13.41.75.75 0 0 0-.99-.82Z" />
                    </svg>
                </button>
            </div>

            {{ $slot }}
        </section>
    </main>
</body>

</html>