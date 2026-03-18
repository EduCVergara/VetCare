<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="text-xl font-semibold text-purple-700">Gestión de Clientes</h2>
            <a href="{{ route('clientes.create') }}"
                class="bg-purple-600 hover:bg-purple-700 text-white px-4 py-2 rounded-lg text-sm font-medium">
                + Nuevo Cliente
            </a>
        </div>
    </x-slot>

    <div class="py-6 max-w-7xl mx-auto px-4">
        @if(session('success'))
            <div class="mb-4 p-3 bg-green-100 text-green-800 rounded-lg text-sm">
                {{ session('success') }}
            </div>
        @endif

        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            @forelse($clientes as $cliente)
                <div class="bg-white rounded-xl border border-gray-200 p-5">
                    <div class="flex justify-between items-start mb-1">
                        <span class="font-medium text-purple-700">{{ $cliente->nombre }}</span>
                        <div class="flex gap-2">
                            <a href="{{ route('clientes.edit', $cliente) }}" class="text-gray-400 hover:text-gray-600">
                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                                    <path
                                        d="M3 17.25V21h3.75L17.81 9.94l-3.75-3.75L3 17.25zM20.71 7.04a1 1 0 0 0 0-1.41l-2.34-2.34a1 1 0 0 0-1.41 0l-1.83 1.83 3.75 3.75 1.83-1.83z" />
                                </svg>
                            </a>
                            <form action="{{ route('clientes.destroy', $cliente) }}" method="POST"
                                onsubmit="return confirm('¿Eliminar este cliente?')">
                                @csrf @method('DELETE')
                                <button type="submit" class="text-red-400 hover:text-red-600">
                                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                                        <path
                                            d="M6 19c0 1.1.9 2 2 2h8c1.1 0 2-.9 2-2V7H6v12zM19 4h-3.5l-1-1h-5l-1 1H5v2h14V4z" />
                                    </svg>
                                </button>
                            </form>
                        </div>
                    </div>
                    <p class="text-xs text-gray-400 mb-3">Cliente desde {{ $cliente->created_at->format('d/m/Y') }}</p>
                    <div class="space-y-1 mb-3 text-sm text-gray-600">
                        <p>✉ {{ $cliente->email }}</p>
                        <p>📞 {{ $cliente->telefono ?? '—' }}</p>
                        <p>📍 {{ $cliente->direccion ?? '—' }}</p>
                    </div>
                    <p class="text-sm">
                        <span class="font-medium text-purple-700">{{ $cliente->pacientes_count }}</span>
                        <span class="text-gray-400">mascotas registradas</span>
                    </p>
                </div>
            @empty
                <div class="col-span-3 text-center py-12 text-gray-400">
                    No hay clientes registrados aún.
                </div>
            @endforelse
        </div>
    </div>
</x-app-layout>