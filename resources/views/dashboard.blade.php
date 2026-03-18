<x-app-layout>
    <x-slot name="header">Dashboard</x-slot>

    {{-- Métricas --}}
    <div class="grid grid-cols-4 gap-4 mb-6">
        <div class="bg-white rounded-xl border border-gray-100 p-4 flex items-start gap-3">
            <div class="w-10 h-10 rounded-xl bg-blue-50 flex items-center justify-center flex-shrink-0">
                <svg class="w-5 h-5 text-blue-500" fill="currentColor" viewBox="0 0 24 24"><path d="M16 11c1.66 0 2.99-1.34 2.99-3S17.66 5 16 5c-1.66 0-3 1.34-3 3s1.34 3 3 3zm-8 0c1.66 0 2.99-1.34 2.99-3S9.66 5 8 5C6.34 5 5 6.34 5 8s1.34 3 3 3zm0 2c-2.33 0-7 1.17-7 3.5V19h14v-2.5c0-2.33-4.67-3.5-7-3.5zm8 0c-.29 0-.62.02-.97.05 1.16.84 1.97 1.97 1.97 3.45V19h6v-2.5c0-2.33-4.67-3.5-7-3.5z"/></svg>
            </div>
            <div>
                <p class="text-xs text-gray-400">Clientes Activos</p>
                <p class="text-2xl font-medium text-blue-500">{{ $totalClientes }}</p>
            </div>
        </div>
        <div class="bg-white rounded-xl border border-gray-100 p-4 flex items-start gap-3">
            <div class="w-10 h-10 rounded-xl bg-teal-50 flex items-center justify-center flex-shrink-0">
                <svg class="w-5 h-5 text-teal-500" fill="currentColor" viewBox="0 0 24 24"><path d="M4.5 10.5C4.5 9.12 5.62 8 7 8s2.5 1.12 2.5 2.5S8.38 13 7 13s-2.5-1.12-2.5-2.5zm10 0C14.5 9.12 15.62 8 17 8s2.5 1.12 2.5 2.5S18.38 13 17 13s-2.5-1.12-2.5-2.5zM7 14c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4zm10 0c-.29 0-.62.02-.97.05 1.16.84 1.97 1.97 1.97 3.45V18h6v-2c0-2.66-5.33-4-8-4z"/></svg>
            </div>
            <div>
                <p class="text-xs text-gray-400">Pacientes Registrados</p>
                <p class="text-2xl font-medium text-teal-500">{{ $totalPacientes }}</p>
            </div>
        </div>
        <div class="bg-white rounded-xl border border-gray-100 p-4 flex items-start gap-3">
            <div class="w-10 h-10 rounded-xl bg-purple-50 flex items-center justify-center flex-shrink-0">
                <svg class="w-5 h-5 text-purple-500" fill="currentColor" viewBox="0 0 24 24"><path d="M17 12h-5v5h5v-5zM16 1v2H8V1H6v2H5c-1.11 0-1.99.9-1.99 2L3 19c0 1.1.89 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2h-1V1h-2zm3 18H5V8h14v11z"/></svg>
            </div>
            <div>
                <p class="text-xs text-gray-400">Citas Hoy</p>
                <p class="text-2xl font-medium text-purple-500">{{ $citasHoy }}</p>
            </div>
        </div>
        <div class="bg-white rounded-xl border border-gray-100 p-4 flex items-start gap-3">
            <div class="w-10 h-10 rounded-xl bg-amber-50 flex items-center justify-center flex-shrink-0">
                <svg class="w-5 h-5 text-amber-500" fill="currentColor" viewBox="0 0 24 24"><path d="M11.8 10.9c-2.27-.59-3-1.2-3-2.15 0-1.09 1.01-1.85 2.7-1.85 1.78 0 2.44.85 2.5 2.1h2.21c-.07-1.72-1.12-3.3-3.21-3.81V3h-3v2.16c-1.94.42-3.5 1.68-3.5 3.61 0 2.31 1.91 3.46 4.7 4.13 2.5.6 3 1.48 3 2.41 0 .69-.49 1.79-2.7 1.79-2.06 0-2.87-.92-2.98-2.1h-2.2c.12 2.19 1.76 3.42 3.68 3.83V21h3v-2.15c1.95-.37 3.5-1.5 3.5-3.55 0-2.84-2.43-3.81-4.7-4.4z"/></svg>
            </div>
            <div>
                <p class="text-xs text-gray-400">Ingresos del Mes</p>
                <p class="text-2xl font-medium text-amber-500">${{ number_format($ingresosMes, 0, ',', '.') }}</p>
            </div>
        </div>
    </div>

    {{-- Citas próximas + Actividad --}}
    <div class="grid grid-cols-3 gap-4">
        <div class="col-span-2 bg-white rounded-xl border border-gray-100 p-5">
            <div class="flex justify-between items-center mb-4">
                <span class="text-sm font-medium text-purple-600">Citas Próximas</span>
                <a href="{{ route('citas.index') }}" class="text-xs text-purple-500 hover:underline">Ver todas</a>
            </div>
            @forelse($citasProximas as $cita)
                <div class="flex items-center gap-3 py-2.5 border-b border-gray-50 last:border-0">
                    <span class="text-xs text-gray-400 w-12 flex-shrink-0">
                        {{ $cita->fecha_hora->format('H:i') }}
                    </span>
                    <div class="flex-1">
                        <p class="text-sm font-medium text-gray-700">{{ $cita->paciente->nombre }}</p>
                        <p class="text-xs text-gray-400">{{ $cita->cliente->nombre }}</p>
                    </div>
                    @php
                        $badges = [
                            'Confirmada'   => 'bg-teal-50 text-teal-700',
                            'Pendiente'    => 'bg-amber-50 text-amber-700',
                            'En consulta'  => 'bg-purple-50 text-purple-700',
                            'Completada'   => 'bg-blue-50 text-blue-700',
                            'Cancelada'    => 'bg-red-50 text-red-700',
                        ];
                    @endphp
                    <span class="text-xs px-2.5 py-0.5 rounded-full {{ $badges[$cita->estado] ?? 'bg-gray-100 text-gray-600' }}">
                        {{ $cita->estado }}
                    </span>
                </div>
            @empty
                <p class="text-sm text-gray-300 text-center py-8">No hay citas próximas</p>
            @endforelse
        </div>

        <div class="bg-white rounded-xl border border-gray-100 p-5">
            <p class="text-sm font-medium text-purple-600 mb-4">Actividad Reciente</p>
            <div class="space-y-4">
                @forelse($actividadReciente as $actividad)
                    <div class="flex gap-2.5">
                        <div class="w-2 h-2 rounded-full mt-1.5 flex-shrink-0"
                             style="background: {{ $actividad['color'] }}"></div>
                        <div>
                            <p class="text-sm font-medium text-gray-700">{{ $actividad['titulo'] }}</p>
                            <p class="text-xs text-gray-400">{{ $actividad['subtitulo'] }}</p>
                            <p class="text-xs text-gray-300">{{ $actividad['tiempo'] }}</p>
                        </div>
                    </div>
                @empty
                    <p class="text-sm text-gray-300 text-center py-4">Sin actividad reciente</p>
                @endforelse
            </div>
        </div>
    </div>

</x-app-layout>