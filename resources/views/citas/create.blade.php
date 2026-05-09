<x-app-layout>
    <x-slot name="header">Nueva Cita</x-slot>

    @php
        $pacientesData = $pacientes->map(function ($paciente) {
            return [
                'id' => $paciente->id,
                'nombre' => $paciente->nombre,
                'especie' => $paciente->especie,
                'cliente_id' => $paciente->cliente_id,
            ];
        })->values();
    @endphp

    <div class="max-w-2xl">
        <div class="bg-white rounded-xl border border-gray-100 p-6 dark:bg-slate-900 dark:border-slate-800">
            <form action="{{ route('citas.store') }}" method="POST" class="space-y-5">
                @csrf

                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xs text-gray-400 mb-1.5 dark:text-slate-400">Cliente <span class="text-red-400">*</span></label>
                        <select name="cliente_id" id="sel-cliente"
                            class="w-full rounded-lg text-sm @error('cliente_id') border-red-300 @enderror" required>
                            <option value="">Seleccionar cliente...</option>
                            @foreach($clientes as $cliente)
                                <option value="{{ $cliente->id }}" {{ old('cliente_id') == $cliente->id ? 'selected' : '' }}>
                                    {{ $cliente->nombre }}
                                </option>
                            @endforeach
                        </select>
                        @error('cliente_id')
                            <p class="text-red-400 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-xs text-gray-400 mb-1.5 dark:text-slate-400">Paciente <span class="text-red-400">*</span></label>
                        <select name="paciente_id" id="sel-paciente"
                            class="w-full rounded-lg text-sm @error('paciente_id') border-red-300 @enderror" required>
                            <option value="">Primero seleccione un cliente...</option>
                            @foreach($pacientes as $paciente)
                                <option value="{{ $paciente->id }}" data-cliente="{{ $paciente->cliente_id }}"
                                    {{ old('paciente_id') == $paciente->id ? 'selected' : '' }}>
                                    {{ $paciente->nombre }} ({{ $paciente->especie }})
                                </option>
                            @endforeach
                        </select>
                        @error('paciente_id')
                            <p class="text-red-400 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-xs text-gray-400 mb-1.5 dark:text-slate-400">Fecha y hora <span class="text-red-400">*</span></label>
                        <input type="datetime-local" name="fecha_hora" value="{{ old('fecha_hora') }}"
                            class="w-full border border-gray-200 rounded-lg px-3 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-purple-300 dark:bg-slate-900 dark:border-slate-700 dark:text-slate-100 dark:[color-scheme:dark] @error('fecha_hora') border-red-300 @enderror"
                            required>
                        @error('fecha_hora')
                            <p class="text-red-400 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-xs text-gray-400 mb-1.5 dark:text-slate-400">Estado <span class="text-red-400">*</span></label>
                        <select name="estado" id="sel-estado" class="w-full rounded-lg text-sm" required>
                            @foreach(['Pendiente', 'Confirmada', 'En consulta', 'Completada', 'Cancelada'] as $estado)
                                <option value="{{ $estado }}" {{ old('estado', 'Pendiente') === $estado ? 'selected' : '' }}>
                                    {{ $estado }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-span-2">
                        <label class="block text-xs text-gray-400 mb-1.5 dark:text-slate-400">Motivo de consulta</label>
                        <textarea name="motivo" rows="3"
                            class="w-full border border-gray-200 rounded-lg px-3 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-purple-300 resize-none dark:bg-slate-900 dark:border-slate-700 dark:text-slate-100"
                            placeholder="Describa el motivo de la cita...">{{ old('motivo') }}</textarea>
                    </div>
                </div>

                <div class="flex gap-3 pt-2">
                    <button type="submit" class="text-white text-sm font-medium px-5 py-2.5 rounded-lg transition"
                        style="background: linear-gradient(135deg, #7F77DD, #534AB7)">
                        Agendar Cita
                    </button>
                    <a href="{{ route('citas.index') }}"
                        class="border border-gray-200 text-gray-400 text-sm px-5 py-2.5 rounded-lg hover:bg-gray-50 transition dark:border-slate-700 dark:text-slate-400 dark:hover:bg-slate-800">
                        Cancelar
                    </a>
                </div>
            </form>
        </div>
    </div>

    @push('scripts')
        <script>
            window.pacientesData = @json($pacientesData);
        </script>
    @endpush
</x-app-layout>
