<x-app-layout>
    <x-slot name="header">Editar Cliente</x-slot>

    <div class="max-w-2xl">
        <div class="bg-white rounded-xl border border-gray-100 p-6">
            <form action="{{ route('clientes.update', $cliente) }}" method="POST" class="space-y-5">
                @csrf
                @method('PUT')

                <div class="grid grid-cols-2 gap-4">
                    <div class="col-span-2">
                        <label class="block text-xs text-gray-400 mb-1.5">Nombre completo <span
                                class="text-red-400">*</span></label>
                        <input type="text" name="nombre" value="{{ old('nombre', $cliente->nombre) }}"
                            class="w-full border border-gray-200 rounded-lg px-3 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-purple-300 @error('nombre') border-red-300 @enderror"
                            required>
                        @error('nombre')
                            <p class="text-red-400 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-xs text-gray-400 mb-1.5">Email <span
                                class="text-red-400">*</span></label>
                        <input type="email" name="email" value="{{ old('email', $cliente->email) }}"
                            class="w-full border border-gray-200 rounded-lg px-3 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-purple-300 @error('email') border-red-300 @enderror"
                            required>
                        @error('email')
                            <p class="text-red-400 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-xs text-gray-400 mb-1.5">Teléfono</label>
                        <input type="text" name="telefono" value="{{ old('telefono', $cliente->telefono) }}"
                            class="w-full border border-gray-200 rounded-lg px-3 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-purple-300"
                            placeholder="+56 9 1234 5678">
                    </div>

                    <div class="col-span-2">
                        <label class="block text-xs text-gray-400 mb-1.5">Dirección</label>
                        <input type="text" name="direccion" value="{{ old('direccion', $cliente->direccion) }}"
                            class="w-full border border-gray-200 rounded-lg px-3 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-purple-300"
                            placeholder="Av. Ejemplo 123, Ciudad">
                    </div>
                </div>

                <div class="flex gap-3 pt-2">
                    <button type="submit" class="text-white text-sm font-medium px-5 py-2.5 rounded-lg transition"
                        style="background: linear-gradient(135deg, #7F77DD, #534AB7)">
                        Actualizar Cliente
                    </button>
                    <a href="{{ route('clientes.index') }}"
                        class="border border-gray-200 text-gray-400 text-sm px-5 py-2.5 rounded-lg hover:bg-gray-50 transition">
                        Cancelar
                    </a>
                </div>

            </form>
        </div>
    </div>

</x-app-layout>