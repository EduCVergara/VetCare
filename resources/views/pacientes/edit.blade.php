<x-app-layout>
    <x-slot name="header">Editar Paciente</x-slot>

    <div class="max-w-2xl">
        <div class="bg-white rounded-xl border border-gray-100 p-6">
            <form action="{{ route('pacientes.update', $paciente) }}" method="POST" class="space-y-5">
                @csrf
                @method('PUT')

                <div class="grid grid-cols-2 gap-4">

                    <div>
                        <label class="block text-xs text-gray-400 mb-1.5">Nombre <span
                                class="text-red-400">*</span></label>
                        <input type="text" name="nombre" value="{{ old('nombre', $paciente->nombre) }}"
                            class="w-full border border-gray-200 rounded-lg px-3 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-purple-300"
                            required>
                        @error('nombre')<p class="text-red-400 text-xs mt-1">{{ $message }}</p>@enderror
                    </div>

                    <div>
                        <label class="block text-xs text-gray-400 mb-1.5">Dueño <span
                                class="text-red-400">*</span></label>
                        <select name="cliente_id"
                            class="w-full border border-gray-200 rounded-lg px-3 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-purple-300"
                            required>
                            @foreach($clientes as $cliente)
                                <option value="{{ $cliente->id }}" {{ old('cliente_id', $paciente->cliente_id) == $cliente->id ? 'selected' : '' }}>
                                    {{ $cliente->nombre }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label class="block text-xs text-gray-400 mb-1.5">Especie <span
                                class="text-red-400">*</span></label>
                        <select name="especie" id="sel-especie"
                            class="w-full border border-gray-200 rounded-lg px-3 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-purple-300"
                            required>
                            @foreach(['Perro', 'Gato', 'Ave', 'Otro'] as $especie)
                                <option value="{{ $especie }}" {{ old('especie', $paciente->especie) === $especie ? 'selected' : '' }}>
                                    {{ $especie }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label class="block text-xs text-gray-400 mb-1.5">Raza</label>
                        <input type="text" name="raza" value="{{ old('raza', $paciente->raza) }}"
                            class="w-full border border-gray-200 rounded-lg px-3 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-purple-300">
                    </div>

                    <div>
                        <label class="block text-xs text-gray-400 mb-1.5">Edad (años)</label>
                        <input type="number" name="edad" value="{{ old('edad', $paciente->edad) }}" min="0"
                            class="w-full border border-gray-200 rounded-lg px-3 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-purple-300">
                    </div>

                    <div>
                        <label class="block text-xs text-gray-400 mb-1.5">Peso (kg)</label>
                        <input type="number" name="peso" value="{{ old('peso', $paciente->peso) }}" min="0" step="0.1"
                            class="w-full border border-gray-200 rounded-lg px-3 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-purple-300">
                    </div>

                    <div>
                        <label class="block text-xs text-gray-400 mb-1.5">Microchip</label>
                        <input type="text" name="microchip" value="{{ old('microchip', $paciente->microchip) }}"
                            class="w-full border border-gray-200 rounded-lg px-3 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-purple-300 @error('microchip') border-red-300 @enderror">
                        @error('microchip')<p class="text-red-400 text-xs mt-1">{{ $message }}</p>@enderror
                    </div>

                    <div>
                        <label class="block text-xs text-gray-400 mb-1.5">Última visita</label>
                        <input type="date" name="ultima_visita"
                            value="{{ old('ultima_visita', $paciente->ultima_visita?->format('Y-m-d')) }}"
                            class="w-full border border-gray-200 rounded-lg px-3 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-purple-300">
                    </div>

                </div>

                <div class="flex gap-3 pt-2">
                    <button type="submit" class="text-white text-sm font-medium px-5 py-2.5 rounded-lg transition"
                        style="background: linear-gradient(135deg, #7F77DD, #534AB7)">
                        Actualizar Paciente
                    </button>
                    <a href="{{ route('pacientes.index') }}"
                        class="border border-gray-200 text-gray-400 text-sm px-5 py-2.5 rounded-lg hover:bg-gray-50 transition">
                        Cancelar
                    </a>
                </div>

            </form>
        </div>
    </div>

</x-app-layout>