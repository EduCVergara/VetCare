<x-app-layout>
    <x-slot name="header">Nuevo paciente</x-slot>

    <div class="max-w-3xl space-y-6">
        <section class="vet-dashboard-surface p-5">
            <p class="text-sm font-semibold text-teal-700 dark:text-teal-300">Nuevo registro</p>
            <h2 class="mt-2 text-3xl font-semibold text-slate-950 dark:text-white">Agregar paciente</h2>
            <p class="mt-2 text-sm text-slate-500 dark:text-slate-400">
                Asocia la mascota a su tutor y guarda los datos clinicos iniciales.
            </p>
        </section>

        <section class="vet-app-card p-6">
            <form action="{{ route('pacientes.store') }}" method="POST" class="space-y-6">
                @csrf

                <div class="grid grid-cols-1 gap-5 md:grid-cols-2">
                    <div>
                        <label for="nombre" class="vet-app-label">Nombre <span class="text-rose-500">*</span></label>
                        <input id="nombre" type="text" name="nombre" value="{{ old('nombre') }}"
                            class="vet-app-input mt-2 @error('nombre') border-rose-300 dark:border-rose-400/60 @enderror"
                            placeholder="Nombre del paciente" required>
                        @error('nombre')<p class="mt-2 text-sm text-rose-500 dark:text-rose-300">{{ $message }}</p>@enderror
                    </div>

                    <div>
                        <label for="sel-paciente-cliente" class="vet-app-label">Tutor <span class="text-rose-500">*</span></label>
                        <select name="cliente_id" id="sel-paciente-cliente"
                            class="vet-app-input mt-2 dark:[color-scheme:dark] @error('cliente_id') border-rose-300 dark:border-rose-400/60 @enderror"
                            required>
                            <option value="">Seleccionar cliente...</option>
                            @foreach($clientes as $cliente)
                                <option value="{{ $cliente->id }}" {{ old('cliente_id') == $cliente->id ? 'selected' : '' }}>
                                    {{ $cliente->nombre }}
                                </option>
                            @endforeach
                        </select>
                        @error('cliente_id')<p class="mt-2 text-sm text-rose-500 dark:text-rose-300">{{ $message }}</p>@enderror
                    </div>

                    <div>
                        <label for="sel-especie" class="vet-app-label">Especie <span class="text-rose-500">*</span></label>
                        <select name="especie" id="sel-especie"
                            class="vet-app-input mt-2 dark:[color-scheme:dark] @error('especie') border-rose-300 dark:border-rose-400/60 @enderror"
                            required>
                            <option value="">Seleccionar...</option>
                            @foreach(['Perro', 'Gato', 'Ave', 'Otro'] as $especie)
                                <option value="{{ $especie }}" {{ old('especie') === $especie ? 'selected' : '' }}>
                                    {{ $especie }}
                                </option>
                            @endforeach
                        </select>
                        @error('especie')<p class="mt-2 text-sm text-rose-500 dark:text-rose-300">{{ $message }}</p>@enderror
                    </div>

                    <div>
                        <label for="raza" class="vet-app-label">Raza</label>
                        <input id="raza" type="text" name="raza" value="{{ old('raza') }}"
                            class="vet-app-input mt-2" placeholder="Ej: Labrador, Siames">
                    </div>

                    <div>
                        <label for="edad" class="vet-app-label">Edad (anos)</label>
                        <input id="edad" type="number" name="edad" value="{{ old('edad') }}" min="0"
                            class="vet-app-input mt-2">
                    </div>

                    <div>
                        <label for="peso" class="vet-app-label">Peso (kg)</label>
                        <input id="peso" type="number" name="peso" value="{{ old('peso') }}" min="0" step="0.1"
                            class="vet-app-input mt-2" placeholder="Ej: 4.5">
                    </div>

                    <div>
                        <label for="microchip" class="vet-app-label">Microchip</label>
                        <input id="microchip" type="text" name="microchip" value="{{ old('microchip') }}"
                            class="vet-app-input mt-2 @error('microchip') border-rose-300 dark:border-rose-400/60 @enderror"
                            placeholder="Ej: MC123456789">
                        @error('microchip')<p class="mt-2 text-sm text-rose-500 dark:text-rose-300">{{ $message }}</p>@enderror
                    </div>

                    <div>
                        <label for="ultima_visita" class="vet-app-label">Ultima visita</label>
                        <input id="ultima_visita" type="date" name="ultima_visita" value="{{ old('ultima_visita') }}"
                            class="vet-app-input mt-2 dark:[color-scheme:dark]">
                    </div>
                </div>

                <div class="flex flex-col-reverse gap-3 border-t border-slate-100 pt-5 dark:border-white/10 sm:flex-row sm:justify-end">
                    <a href="{{ route('pacientes.index') }}" class="vet-app-button-secondary">
                        Cancelar
                    </a>
                    <button type="submit" class="vet-app-button-primary">
                        Guardar paciente
                    </button>
                </div>
            </form>
        </section>
    </div>
</x-app-layout>
