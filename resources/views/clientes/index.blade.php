<x-app-layout>
    <x-slot name="header">Gestión de Clientes</x-slot>

    <div class="flex justify-between items-center mb-6">
        <div class="relative w-80">
            <svg class="absolute left-3 top-1/2 -translate-y-1/2 w-4 h-4 text-gray-300 dark:text-slate-500" fill="currentColor" viewBox="0 0 24 24">
                <path d="M15.5 14h-.79l-.28-.27A6.471 6.471 0 0 0 16 9.5 6.5 6.5 0 1 0 9.5 16c1.61 0 3.09-.59 4.23-1.57l.27.28v.79l5 4.99L20.49 19l-4.99-5zm-6 0C7.01 14 5 11.99 5 9.5S7.01 5 9.5 5 14 7.01 14 9.5 11.99 14 9.5 14z" />
            </svg>
            <input type="text" placeholder="Buscar clientes..." id="buscar-clientes"
                class="w-full pl-9 pr-4 py-2 text-sm border border-gray-200 rounded-lg bg-gray-50 focus:outline-none focus:ring-2 focus:ring-purple-300 dark:bg-slate-900 dark:border-slate-700 dark:text-slate-100">
        </div>
        <a href="{{ route('clientes.create') }}" class="text-white text-sm font-medium px-4 py-2 rounded-lg transition" style="background: linear-gradient(135deg, #7F77DD, #534AB7)">
            + Nuevo Cliente
        </a>
    </div>

    <div id="lista-clientes" class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-4">
        @forelse($clientes as $cliente)
            <div class="cliente-card bg-white rounded-xl border border-gray-100 p-5 dark:bg-slate-900 dark:border-slate-800"
                data-nombre="{{ strtolower($cliente->nombre) }}" data-email="{{ strtolower($cliente->email) }}">
                <div class="flex justify-between items-start mb-1">
                    <span class="font-medium text-purple-700 dark:text-violet-300">{{ $cliente->nombre }}</span>
                    <div class="flex gap-2">
                        <a href="{{ route('clientes.edit', $cliente) }}" class="text-gray-300 hover:text-gray-500 transition dark:text-slate-500 dark:hover:text-slate-300">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M3 17.25V21h3.75L17.81 9.94l-3.75-3.75L3 17.25zM20.71 7.04a1 1 0 0 0 0-1.41l-2.34-2.34a1 1 0 0 0-1.41 0l-1.83 1.83 3.75 3.75 1.83-1.83z" />
                            </svg>
                        </a>
                        <form action="{{ route('clientes.destroy', $cliente) }}" method="POST" data-confirm="¿Eliminar a {{ $cliente->nombre }}?" data-confirm-text="También se eliminarán sus pacientes y citas.">
                            @csrf @method('DELETE')
                            <button type="submit" class="text-gray-300 hover:text-red-400 transition dark:text-slate-500 dark:hover:text-red-400">
                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M6 19c0 1.1.9 2 2 2h8c1.1 0 2-.9 2-2V7H6v12zM19 4h-3.5l-1-1h-5l-1 1H5v2h14V4z" />
                                </svg>
                            </button>
                        </form>
                    </div>
                </div>

                <p class="text-xs text-gray-300 mb-4 dark:text-slate-500">Cliente desde {{ $cliente->created_at->translatedFormat('d/m/Y') }}</p>

                <div class="space-y-1.5 mb-4">
                    <div class="flex items-center gap-2 text-sm text-gray-500 dark:text-slate-300">
                        <svg class="w-3.5 h-3.5 text-purple-300 flex-shrink-0" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M20 4H4c-1.1 0-2 .9-2 2v12c0 1.1.9 2 2 2h16c1.1 0 2-.9 2-2V6c0-1.1-.9-2-2-2zm0 4-8 5-8-5V6l8 5 8-5v2z" />
                        </svg>
                        {{ $cliente->email }}
                    </div>
                    <div class="flex items-center gap-2 text-sm text-gray-500 dark:text-slate-300">
                        <svg class="w-3.5 h-3.5 text-teal-300 flex-shrink-0" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M6.62 10.79c1.44 2.83 3.76 5.14 6.59 6.59l2.2-2.2c.27-.27.67-.36 1.02-.24 1.12.37 2.33.57 3.57.57.55 0 1 .45 1 1V20c0 .55-.45 1-1 1-9.39 0-17-7.61-17-17 0-.55.45-1 1-1h3.5c.55 0 1 .45 1 1 0 1.25.2 2.45.57 3.57.11.35.03.74-.25 1.02l-2.2 2.2z" />
                        </svg>
                        {{ $cliente->telefono ?? '—' }}
                    </div>
                    <div class="flex items-center gap-2 text-sm text-gray-500 dark:text-slate-300">
                        <svg class="w-3.5 h-3.5 text-red-300 flex-shrink-0" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7zm0 9.5c-1.38 0-2.5-1.12-2.5-2.5s1.12-2.5 2.5-2.5 2.5 1.12 2.5 2.5-1.12 2.5-2.5 2.5z" />
                        </svg>
                        {{ $cliente->direccion ?? '—' }}
                    </div>
                </div>

                <div class="pt-3 border-t border-gray-50 text-sm dark:border-slate-800">
                    <span class="font-medium text-purple-600">{{ $cliente->pacientes_count }}</span>
                    <span class="text-gray-300 dark:text-slate-500">
                        {{ $cliente->pacientes_count === 1 ? 'mascota registrada' : 'mascotas registradas' }}
                    </span>
                </div>
            </div>
        @empty
            <div class="col-span-3 text-center py-16 text-gray-300 dark:text-slate-500">
                <svg class="w-12 h-12 mx-auto mb-3 text-gray-200 dark:text-slate-700" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M16 11c1.66 0 2.99-1.34 2.99-3S17.66 5 16 5c-1.66 0-3 1.34-3 3s1.34 3 3 3zm-8 0c1.66 0 2.99-1.34 2.99-3S9.66 5 8 5C6.34 5 5 6.34 5 8s1.34 3 3 3zm0 2c-2.33 0-7 1.17-7 3.5V19h14v-2.5c0-2.33-4.67-3.5-7-3.5zm8 0c-.29 0-.62.02-.97.05 1.16.84 1.97 1.97 1.97 3.45V19h6v-2.5c0-2.33-4.67-3.5-7-3.5z" />
                </svg>
                No hay clientes registrados aún.
            </div>
        @endforelse
    </div>

    <x-slot name="scripts">
        @vite('resources/js/clientes.js')
    </x-slot>
</x-app-layout>
