<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name') }} — {{ $title ?? 'Dashboard' }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="min-h-screen bg-gray-50 flex">

    {{-- SIDEBAR --}}
    <aside class="w-60 min-h-screen bg-white border-r border-gray-100 flex flex-col flex-shrink-0">

        {{-- Logo --}}
        <div class="flex items-center gap-3 px-4 py-5 border-b border-gray-100">
            <div class="w-10 h-10 rounded-xl flex items-center justify-center flex-shrink-0"
                style="background: linear-gradient(135deg, #7F77DD, #1D9E75)">
                <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 24 24">
                    <path
                        d="M4.5 10.5C4.5 9.12 5.62 8 7 8s2.5 1.12 2.5 2.5S8.38 13 7 13s-2.5-1.12-2.5-2.5zm10 0C14.5 9.12 15.62 8 17 8s2.5 1.12 2.5 2.5S18.38 13 17 13s-2.5-1.12-2.5-2.5zM7 14c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4zm10 0c-.29 0-.62.02-.97.05 1.16.84 1.97 1.97 1.97 3.45V18h6v-2c0-2.66-5.33-4-8-4z" />
                </svg>
            </div>
            <div>
                <p class="text-sm font-semibold text-gray-800 leading-tight">VetCare</p>
                <p class="text-xs text-gray-400 leading-tight">Sistema de Gestión</p>
            </div>
        </div>

        {{-- Navegación --}}
        <nav class="flex-1 px-2 py-3 space-y-0.5">

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

            @if(Route::has('historial.index'))
                <x-nav-link route="historial.index" icon="historial">
                    Historial Médico
                </x-nav-link>
            @endif

            @if(Route::has('facturacion.index'))
                <x-nav-link route="facturacion.index" icon="facturacion">
                    Facturación
                </x-nav-link>
            @endif

            @if(Route::has('inventario.index'))
                <x-nav-link route="inventario.index" icon="inventario">
                    Inventario
                </x-nav-link>
            @endif

            @if(auth()->user()->rol === 'admin')
                <div class="pt-3 pb-1 px-3">
                    <p class="text-xs text-gray-300 uppercase tracking-wider">Administración</p>
                </div>
                <x-nav-link route="usuarios.index" icon="usuarios">
                    Usuarios
                </x-nav-link>
            @endif

        </nav>

        {{-- Usuario autenticado --}}
        <div class="px-3 py-4 border-t border-gray-100">
            <div class="flex items-center gap-3">
                <div class="w-9 h-9 rounded-full flex items-center justify-center text-xs font-medium"
                    style="background:#EEEDFE; color:#534AB7">
                    {{ strtoupper(substr(auth()->user()->nombre, 0, 2)) }}
                </div>
                <div class="flex-1 min-w-0">
                    <p class="text-sm font-medium text-gray-700 truncate">{{ auth()->user()->nombre }}</p>
                    <p class="text-xs text-gray-400 truncate capitalize">{{ auth()->user()->rol }}</p>
                </div>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" title="Cerrar sesión" class="text-gray-300 hover:text-red-400 transition">
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                            <path
                                d="M17 7l-1.41 1.41L18.17 11H8v2h10.17l-2.58 2.58L17 17l5-5-5-5zM4 5h8V3H4c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h8v-2H4V5z" />
                        </svg>
                    </button>
                </form>
            </div>
        </div>

    </aside>

    {{-- CONTENIDO PRINCIPAL --}}
    <div class="flex-1 flex flex-col min-h-screen">

        {{-- Topbar --}}
        <header class="bg-white border-b border-gray-100 px-8 py-4 flex justify-between items-center">
            <div>
                <h1 class="text-xl font-medium text-purple-700">{{ $header ?? 'Dashboard' }}</h1>
                <p class="text-xs text-gray-400 mt-0.5">
                    {{ ucfirst(\Carbon\Carbon::now()->isoFormat('dddd, D [de] MMMM [de] YYYY')) }}
                </p>
            </div>
            <div class="flex items-center gap-3">
                {{-- Notificaciones --}}
                <button
                    class="w-9 h-9 rounded-full bg-gray-50 border border-gray-100 flex items-center justify-center hover:bg-gray-100 transition">
                    <svg class="w-4 h-4 text-gray-400" fill="currentColor" viewBox="0 0 24 24">
                        <path
                            d="M12 22c1.1 0 2-.9 2-2h-4c0 1.1.9 2 2 2zm6-6v-5c0-3.07-1.64-5.64-4.5-6.32V4c0-.83-.67-1.5-1.5-1.5s-1.5.67-1.5 1.5v.68C7.63 5.36 6 7.92 6 11v5l-2 2v1h16v-1l-2-2z" />
                    </svg>
                </button>
                {{-- Avatar --}}
                <div class="w-9 h-9 rounded-full flex items-center justify-center text-xs font-medium"
                    style="background:#EEEDFE; color:#534AB7">
                    {{ strtoupper(substr(auth()->user()->nombre, 0, 2)) }}
                </div>
            </div>
        </header>

        {{-- Página --}}
        <main class="flex-1 p-8">

            {{-- Flash messages --}}
            @if(session('success'))
                <div class="mb-5 px-4 py-3 bg-green-50 border border-green-100 text-green-700 rounded-lg text-sm">
                    {{ session('success') }}
                </div>
            @endif

            @if(session('error'))
                <div class="mb-5 px-4 py-3 bg-red-50 border border-red-100 text-red-700 rounded-lg text-sm">
                    {{ session('error') }}
                </div>
            @endif

            {{ $slot }}

        </main>

    </div>

</body>

</html>