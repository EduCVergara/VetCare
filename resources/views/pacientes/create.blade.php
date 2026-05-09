<x-app-layout>
    <x-slot name="header">Nuevo Paciente</x-slot>

    <div class="max-w-2xl">
        <div class="bg-white rounded-xl border border-gray-100 p-6">
            <form action="{{ route('pacientes.store') }}" method="POST" class="space-y-5">
                @csrf

                <div class="grid grid-cols-2 gap-4">

                    {{-- Nombre --}}
                    <div>
                        <label class="block text-xs text-gray-400 mb-1.5">Nombre <span
                                class="text-red-400">*</span></label>
                        <input type="text" name="nombre" value="{{ old('nombre') }}"
                            class="w-full border border-gray-200 rounded-lg px-3 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-purple-300 @error('nombre') border-red-300 @enderror"
                            required>
                        @error('nombre')<p class="text-red-400 text-xs mt-1">{{ $message }}</p>@enderror
                    </div>

                    {{-- Dueño --}}
                    <div>
                        <label class="block text-xs text-gray-400 mb-1.5">Dueño <span
                                class="text-red-400">*</span></label>
                        <select name="cliente_id"
                            class="w-full border border-gray-200 rounded-lg px-3 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-purple-300 @error('cliente_id') border-red-300 @enderror"
                            required>
                            <option value="">Seleccionar cliente...</option>
                            @foreach($clientes as $cliente)
                                <option value="{{ $cliente->id }}" {{ old('cliente_id') == $cliente->id ? 'selected' : '' }}>
                                    {{ $cliente->nombre }}
                                </option>
                            @endforeach
                        </select>
                        @error('cliente_id')<p class="text-red-400 text-xs mt-1">{{ $message }}</p>@enderror
                    </div>

                    {{-- Especie --}}
                    <div>
                        <label class="block text-xs text-gray-400 mb-1.5">Especie <span
                                class="text-red-400">*</span></label>
                        <select name="especie" id="sel-especie"
                            class="w-full border border-gray-200 rounded-lg px-3 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-purple-300"
                            required>
                            <option value="">Seleccionar...</option>
                            @foreach(['Perro', 'Gato', 'Ave', 'Otro'] as $especie)
                                <option value="{{ $especie }}" {{ old('especie') === $especie ? 'selected' : '' }}>
                                    {{ $especie }}
                                </option>
                            @endforeach
                        </select>
                        @error('especie')<p class="text-red-400 text-xs mt-1">{{ $message }}</p>@enderror
                    </div>

                    {{-- Raza --}}
                    <div>
                        <label class="block text-xs text-gray-400 mb-1.5">Raza</label>
                        <input type="text" name="raza" value="{{ old('raza') }}"
                            class="w-full border border-gray-200 rounded-lg px-3 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-purple-300"
                            placeholder="Ej: Labrador, Siamés...">
                    </div>

                    {{-- Edad --}}
                    <div>
                        <label class="block text-xs text-gray-400 mb-1.5">Edad (años)</label>
                        <input type="number" name="edad" value="{{ old('edad') }}" min="0"
                            class="w-full border border-gray-200 rounded-lg px-3 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-purple-300">
                    </div>

                    {{-- Peso --}}
                    <div>
                        <label class="block text-xs text-gray-400 mb-1.5">Peso (kg)</label>
                        <input type="number" name="peso" value="{{ old('peso') }}" min="0" step="0.1"
                            class="w-full border border-gray-200 rounded-lg px-3 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-purple-300"
                            placeholder="Ej: 4.5">
                    </div>

                    {{-- Microchip --}}
                    <div>
                        <label class="block text-xs text-gray-400 mb-1.5">Microchip</label>
                        <input type="text" name="microchip" value="{{ old('microchip') }}"
                            class="w-full border border-gray-200 rounded-lg px-3 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-purple-300 @error('microchip') border-red-300 @enderror"
                            placeholder="Ej: MC123456789">
                        @error('microchip')<p class="text-red-400 text-xs mt-1">{{ $message }}</p>@enderror
                    </div>

                    {{-- Última visita --}}
                    <div>
                        <label class="block text-xs text-gray-400 mb-1.5">Última visita</label>
                        <input type="date" name="ultima_visita" value="{{ old('ultima_visita') }}"
                            class="w-full border border-gray-200 rounded-lg px-3 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-purple-300">
                    </div>

                </div>

                <div class="flex gap-3 pt-2">
                    <button type="submit" class="text-white text-sm font-medium px-5 py-2.5 rounded-lg transition"
                        style="background: linear-gradient(135deg, #7F77DD, #534AB7)">
                        Guardar Paciente
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