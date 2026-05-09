<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'VetCare') }}</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="min-h-screen bg-gradient-to-br from-purple-50 via-white to-teal-50 flex items-center justify-center">
    <div class="w-full max-w-md px-6">
        <div class="flex flex-col items-center mb-8">
            <div class="w-16 h-16 rounded-2xl flex items-center justify-center mb-3"
                style="background: linear-gradient(135deg, #7F77DD, #1D9E75)">
                <svg class="w-9 h-9 text-white" fill="currentColor" viewBox="0 0 24 24">
                    <path
                        d="M4.5 10.5C4.5 9.12 5.62 8 7 8s2.5 1.12 2.5 2.5S8.38 13 7 13s-2.5-1.12-2.5-2.5zm10 0C14.5 9.12 15.62 8 17 8s2.5 1.12 2.5 2.5S18.38 13 17 13s-2.5-1.12-2.5-2.5zM7 14c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4zm10 0c-.29 0-.62.02-.97.05 1.16.84 1.97 1.97 1.97 3.45V18h6v-2c0-2.66-5.33-4-8-4z" />
                </svg>
            </div>
            <h1 class="text-2xl font-semibold text-gray-800">VetCare</h1>
            <p class="text-sm text-gray-400">Sistema de Gestión Veterinaria</p>
        </div>

        <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-8">
            {{ $slot }}
        </div>

        <p class="text-center text-xs text-gray-300 mt-6">VetCare &copy; {{ date('Y') }}</p>
    </div>
</body>

</html>
