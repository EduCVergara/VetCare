<x-app-layout>
    <x-slot name="header">Gestión de Pacientes</x-slot>

    <div class="flex justify-between items-center mb-6">
        <div class="relative w-80">
            <svg class="absolute left-3 top-1/2 -translate-y-1/2 w-4 h-4 text-gray-300 dark:text-slate-500" fill="currentColor" viewBox="0 0 24 24">
                <path d="M15.5 14h-.79l-.28-.27A6.471 6.471 0 0 0 16 9.5 6.5 6.5 0 1 0 9.5 16c1.61 0 3.09-.59 4.23-1.57l.27.28v.79l5 4.99L20.49 19l-4.99-5zm-6 0C7.01 14 5 11.99 5 9.5S7.01 5 9.5 5 14 7.01 14 9.5 11.99 14 9.5 14z" />
            </svg>
            <input type="text" placeholder="Buscar pacientes..." id="buscar-pacientes"
                class="w-full pl-9 pr-4 py-2 text-sm border border-gray-200 rounded-lg bg-gray-50 focus:outline-none focus:ring-2 focus:ring-purple-300 dark:bg-slate-900 dark:border-slate-700 dark:text-slate-100">
        </div>
        <a href="{{ route('pacientes.create') }}" class="text-white text-sm font-medium px-4 py-2 rounded-lg transition" style="background: linear-gradient(135deg, #7F77DD, #534AB7)">
            + Nuevo Paciente
        </a>
    </div>

    @php
        $badgeEspecie = [
            'Perro' => 'bg-blue-50 text-blue-600 dark:bg-blue-500/15 dark:text-blue-300',
            'Gato' => 'bg-pink-50 text-pink-600 dark:bg-pink-500/15 dark:text-pink-300',
            'Ave' => 'bg-green-50 text-green-600 dark:bg-green-500/15 dark:text-green-300',
            'Otro' => 'bg-gray-100 text-gray-500 dark:bg-slate-800 dark:text-slate-300',
        ];
    @endphp

    <div id="lista-pacientes" class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-4">
        @forelse($pacientes as $paciente)
            <div class="paciente-card bg-white rounded-xl border border-gray-100 p-5 dark:bg-slate-900 dark:border-slate-800"
                data-nombre="{{ strtolower($paciente->nombre) }}" data-dueno="{{ strtolower($paciente->cliente->nombre) }}">
                <div class="flex justify-between items-start mb-1">
                    <div class="flex items-center gap-2">
                        <span class="font-medium text-gray-800 dark:text-slate-100">{{ $paciente->nombre }}</span>
                        <span class="text-xs px-2 py-0.5 rounded-full font-medium {{ $badgeEspecie[$paciente->especie] ?? 'bg-gray-100 text-gray-500 dark:bg-slate-800 dark:text-slate-300' }}">
                            {{ $paciente->especie }}
                        </span>
                    </div>
                    <div class="flex gap-2">
                        <a href="{{ route('pacientes.edit', $paciente) }}" class="text-gray-300 hover:text-gray-500 transition dark:text-slate-500 dark:hover:text-slate-300">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M3 17.25V21h3.75L17.81 9.94l-3.75-3.75L3 17.25zM20.71 7.04a1 1 0 0 0 0-1.41l-2.34-2.34a1 1 0 0 0-1.41 0l-1.83 1.83 3.75 3.75 1.83-1.83z" />
                            </svg>
                        </a>
                        <form action="{{ route('pacientes.destroy', $paciente) }}" method="POST" data-confirm="¿Eliminar a {{ $paciente->nombre }}?" data-confirm-text="Esta acción no se puede deshacer.">
                            @csrf @method('DELETE')
                            <button type="submit" class="text-gray-300 hover:text-red-400 transition dark:text-slate-500 dark:hover:text-red-400">
                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M6 19c0 1.1.9 2 2 2h8c1.1 0 2-.9 2-2V7H6v12zM19 4h-3.5l-1-1h-5l-1 1H5v2h14V4z" />
                                </svg>
                            </button>
                        </form>
                    </div>
                </div>

                <p class="text-xs text-gray-400 mb-4 dark:text-slate-400">{{ $paciente->raza ?? 'Raza no especificada' }}</p>

                <div class="grid grid-cols-2 gap-3 mb-4">
                    <div>
                        <p class="text-xs text-purple-400 dark:text-violet-300">Edad</p>
                        <p class="text-sm font-medium text-gray-700 dark:text-slate-100">
                            {{ $paciente->edad ? $paciente->edad . ' ' . ($paciente->edad === 1 ? 'año' : 'años') : '—' }}
                        </p>
                    </div>
                    <div>
                        <p class="text-xs text-purple-400 dark:text-violet-300">Peso</p>
                        <p class="text-sm font-medium text-gray-700 dark:text-slate-100">
                            {{ $paciente->peso ? $paciente->peso . ' kg' : '—' }}
                        </p>
                    </div>
                </div>

                <div class="space-y-1.5 mb-4 text-sm text-gray-500 dark:text-slate-300">
                    <p>Dueño: <span class="text-gray-700 dark:text-slate-100">{{ $paciente->cliente->nombre }}</span></p>
                    @if($paciente->microchip)
                        <p class="text-xs text-purple-400 dark:text-violet-300">
                            Microchip: <span class="font-mono text-gray-500 dark:text-slate-300">{{ $paciente->microchip }}</span>
                        </p>
                    @endif
                    @if($paciente->ultima_visita)
                        <div class="flex items-center gap-1.5 text-xs text-gray-400 dark:text-slate-400">
                            <svg class="w-3.5 h-3.5" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M17 12h-5v5h5v-5zM16 1v2H8V1H6v2H5c-1.11 0-1.99.9-1.99 2L3 19c0 1.1.89 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2h-1V1h-2zm3 18H5V8h14v11z" />
                            </svg>
                            Última visita: {{ $paciente->ultima_visita->translatedFormat('d/m/Y') }}
                        </div>
                    @endif
                </div>

                @if(Route::has('historial.index'))
                    <a href="{{ route('historial.index', ['paciente' => $paciente->id]) }}" class="block w-full text-center text-white text-sm font-medium py-2 rounded-lg transition" style="background: linear-gradient(135deg, #7F77DD, #534AB7)">
                        Ver Historial Médico
                    </a>
                @endif
            </div>
        @empty
            <div class="col-span-3 text-center py-16 text-gray-300 dark:text-slate-500">
                <svg class="w-12 h-12 mx-auto mb-3 text-gray-200 dark:text-slate-700" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M4.5 10.5C4.5 9.12 5.62 8 7 8s2.5 1.12 2.5 2.5S8.38 13 7 13s-2.5-1.12-2.5-2.5zm10 0C14.5 9.12 15.62 8 17 8s2.5 1.12 2.5 2.5S18.38 13 17 13s-2.5-1.12-2.5-2.5zM9.5 11.5C8.01 11.5 6 13.51 6 16v1h6v-1c0-2.49-2.01-4.5-4.5-4.5zM17 13c-2.49 0-4.5 2.01-4.5 4.5v1H18v-1c0-2.49-2.01-4.5-4.5-4.5z" />
                </svg>
                No hay pacientes registrados aún.
            </div>
        @endforelse
    </div>

    <x-slot name="scripts">
        @vite('resources/js/pacientes.js')
    </x-slot>
</x-app-layout>
