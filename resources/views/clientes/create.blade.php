<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold text-purple-700">Nuevo Cliente</h2>
    </x-slot>

    <div class="py-6 max-w-2xl mx-auto px-4">
        <div class="bg-white rounded-xl border border-gray-200 p-6">
            <form action="{{ route('clientes.store') }}" method="POST" class="space-y-4">
                @csrf
                <div>
                    <label class="block text-sm text-gray-600 mb-1">Nombre completo</label>
                    <input type="text" name="nombre" value="{{ old('nombre') }}"
                        class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-purple-400"
                        required>
                    @error('nombre')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                </div>
                <div>
                    <label class="block text-sm text-gray-600 mb-1">Email</label>
                    <input type="email" name="email" value="{{ old('email') }}"
                        class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-purple-400"
                        required>
                    @error('email')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                </div>
                <div>
                    <label class="block text-sm text-gray-600 mb-1">Teléfono</label>
                    <input type="text" name="telefono" value="{{ old('telefono') }}"
                        class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-purple-400">
                </div>
                <div>
                    <label class="block text-sm text-gray-600 mb-1">Dirección</label>
                    <input type="text" name="direccion" value="{{ old('direccion') }}"
                        class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-purple-400">
                </div>
                <div class="flex gap-3 pt-2">
                    <button type="submit"
                        class="bg-purple-600 hover:bg-purple-700 text-white px-5 py-2 rounded-lg text-sm font-medium">
                        Guardar
                    </button>
                    <a href="{{ route('clientes.index') }}"
                        class="border border-gray-200 text-gray-600 px-5 py-2 rounded-lg text-sm hover:bg-gray-50">
                        Cancelar
                    </a>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>