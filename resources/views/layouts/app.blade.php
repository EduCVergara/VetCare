<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script>
        (() => {
            const themeKey = 'vetcare-theme';
            const savedTheme = localStorage.getItem(themeKey);
            const prefersDark = window.matchMedia('(prefers-color-scheme: dark)').matches;
            const theme = savedTheme === 'light' || savedTheme === 'dark'
                ? savedTheme
                : (prefersDark ? 'dark' : 'light');

            document.documentElement.classList.toggle('dark', theme === 'dark');
            document.documentElement.dataset.theme = theme;
        })();
    </script>
    <title>{{ config('app.name') }} — {{ $title ?? 'Dashboard' }}</title>
    @vite([
        'resources/css/app.css',
        'resources/js/app.js',
        'resources/js/clientes.js',
        'resources/js/pacientes.js',
        'resources/js/citas.js',
        'resources/js/usuarios.js'
    ])
</head>

<body class="min-h-screen bg-slate-50 text-slate-900 flex dark:bg-slate-950 dark:text-slate-100">

    <aside class="vet-sidebar">
        <div class="relative flex items-center gap-3 px-4 py-5">
            <div class="vet-brand-mark h-11 w-11 rounded-2xl">
                <x-icon.paw class="h-6 w-6" />
            </div>
            <div>
                <p class="text-sm font-semibold leading-tight text-slate-900 dark:text-white">VetCare</p>
                <p class="text-xs leading-tight text-slate-500 dark:text-slate-400">UI 2.0</p>
            </div>
        </div>

        <nav class="relative flex-1 space-y-1.5 px-3 py-2">
            <div class="px-3 pb-2">
                <p class="text-[11px] font-semibold uppercase text-slate-400 dark:text-slate-500">Principal</p>
            </div>

            <x-nav-link route="dashboard" icon="dashboard">
                Dashboard
            </x-nav-link>

            @if(Route::has('clientes.index'))
                <x-nav-link route="clientes.index" icon="clientes">
                    Clientes
                </x-nav-link>
            @endif

            @if(Route::has('pacientes.index'))
                <x-nav-link route="pacientes.index" icon="pacientes">
                    Pacientes
                </x-nav-link>
            @endif

            @if(Route::has('citas.index'))
                <x-nav-link route="citas.index" icon="citas">
                    Citas
                </x-nav-link>
            @endif

            @if(auth()->user()->rol === 'admin')
                <div class="px-3 pb-2 pt-5">
                    <p class="text-[11px] font-semibold uppercase text-slate-400 dark:text-slate-500">Administración</p>
                </div>
                <x-nav-link route="usuarios.index" icon="usuarios">
                    Usuarios
                </x-nav-link>
            @endif
        </nav>

        <div class="relative px-3 pb-4 pt-3">
            <div
                class="rounded-[22px] border border-slate-200/70 bg-white/70 p-3 shadow-sm shadow-teal-900/5 backdrop-blur dark:border-white/10 dark:bg-white/[0.045]">
                <div class="flex items-center gap-3">
                    <a href="{{ route('profile.edit') }}" title="Ver perfil"
                        class="flex min-w-0 flex-1 items-center gap-3 rounded-2xl p-1.5 transition hover:bg-teal-50/70 focus:outline-none focus:ring-4 focus:ring-teal-500/10 dark:hover:bg-teal-300/10">
                        <div
                            class="flex h-10 w-10 shrink-0 items-center justify-center rounded-2xl bg-teal-50 text-xs font-semibold text-teal-700 dark:bg-teal-300/10 dark:text-teal-200">
                            {{ strtoupper(substr(auth()->user()->nombre, 0, 2)) }}
                        </div>
                        <div class="min-w-0 flex-1">
                            <p class="truncate text-sm font-semibold text-slate-800 dark:text-slate-100">
                                {{ auth()->user()->nombre }}
                            </p>
                            <p class="truncate text-xs capitalize text-slate-500 dark:text-slate-400">
                                Perfil · {{ auth()->user()->rol }}
                            </p>
                        </div>
                    </a>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" title="Cerrar sesión"
                            class="flex h-9 w-9 items-center justify-center rounded-xl text-slate-400 transition hover:bg-rose-50 hover:text-rose-500 focus:outline-none focus:ring-4 focus:ring-rose-500/10 dark:text-slate-500 dark:hover:bg-rose-400/10 dark:hover:text-rose-300">
                            <svg class="h-4 w-4" fill="currentColor" viewBox="0 0 24 24">
                                <path
                                    d="M17 7l-1.41 1.41L18.17 11H8v2h10.17l-2.58 2.58L17 17l5-5-5-5zM4 5h8V3H4c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h8v-2H4V5z" />
                            </svg>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </aside>

    <div class="flex-1 flex flex-col min-h-screen">
        <header
            class="bg-white border-b border-gray-100 px-8 py-4 flex justify-between items-center dark:bg-slate-900 dark:border-slate-800">
            <div>
                <h1 class="text-xl font-medium text-purple-700 dark:text-violet-300">{{ $header ?? 'Dashboard' }}</h1>
                <p class="text-xs text-gray-400 mt-0.5 dark:text-slate-400">
                    {{ ucfirst(\Carbon\Carbon::now()->isoFormat('dddd, D [de] MMMM [de] YYYY')) }}
                </p>
            </div>
            <div class="flex items-center gap-3">
                <button data-theme-toggle
                    class="w-9 h-9 rounded-full bg-gray-50 border border-gray-100 flex items-center justify-center hover:bg-gray-100 transition dark:bg-slate-800 dark:border-slate-700 dark:hover:bg-slate-700"
                    aria-label="Cambiar tema" aria-pressed="false">
                    <svg class="w-4 h-4 text-gray-500 dark:hidden" fill="currentColor" viewBox="0 0 24 24">
                        <path
                            d="M6.76 4.84l-1.8-1.79-1.41 1.41 1.79 1.8 1.42-1.42zM1 13h3v-2H1v2zm10-9h2V1h-2v3zm7.45 2.46 1.41-1.41-1.79-1.8-1.42 1.42 1.8 1.79zM17.24 19.16l1.8 1.79 1.41-1.41-1.79-1.8-1.42 1.42zM20 11v2h3v-2h-3zm-8 9h-2v3h2v-3zm-5.24-1.16-1.42-1.42-1.79 1.8 1.41 1.41 1.8-1.79zM12 6a6 6 0 1 0 0 12 6 6 0 0 0 0-12z" />
                    </svg>
                    <svg class="hidden w-4 h-4 text-slate-300 dark:block" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M9.37 5.51A7 7 0 0 0 18.49 14.63 8 8 0 1 1 9.37 5.51z" />
                    </svg>
                </button>

                <button
                    class="w-9 h-9 rounded-full bg-gray-50 border border-gray-100 flex items-center justify-center hover:bg-gray-100 transition dark:bg-slate-800 dark:border-slate-700 dark:hover:bg-slate-700">
                    <svg class="w-4 h-4 text-gray-400 dark:text-slate-400" fill="currentColor" viewBox="0 0 24 24">
                        <path
                            d="M12 22c1.1 0 2-.9 2-2h-4c0 1.1.9 2 2 2zm6-6v-5c0-3.07-1.64-5.64-4.5-6.32V4c0-.83-.67-1.5-1.5-1.5s-1.5.67-1.5 1.5v.68C7.63 5.36 6 7.92 6 11v5l-2 2v1h16v-1l-2-2z" />
                    </svg>
                </button>

                <div class="w-9 h-9 rounded-full flex items-center justify-center text-xs font-medium"
                    style="background:#EEEDFE; color:#534AB7">
                    {{ strtoupper(substr(auth()->user()->nombre, 0, 2)) }}
                </div>
            </div>
        </header>

        <main class="flex-1 p-8">
            @if(session('success'))
                <div
                    class="mb-5 px-4 py-3 bg-green-50 border border-green-100 text-green-700 rounded-lg text-sm dark:bg-emerald-500/10 dark:border-emerald-500/20 dark:text-emerald-300">
                    {{ session('success') }}
                </div>
            @endif

            @if(session('error'))
                <div
                    class="mb-5 px-4 py-3 bg-red-50 border border-red-100 text-red-700 rounded-lg text-sm dark:bg-red-500/10 dark:border-red-500/20 dark:text-red-300">
                    {{ session('error') }}
                </div>
            @endif

            {{ $slot }}
        </main>
    </div>

    @stack('scripts')
    @isset($scripts)
        {{ $scripts }}
    @endisset
</body>

</html>
