<x-app-layout>
    <x-slot name="header">Nuevo cliente</x-slot>

    <div class="max-w-3xl space-y-6">
        <section class="vet-dashboard-surface p-5">
            <p class="text-sm font-semibold text-teal-700 dark:text-teal-300">Nuevo registro</p>
            <h2 class="mt-2 text-3xl font-semibold text-slate-950 dark:text-white">Agregar cliente</h2>
            <p class="mt-2 text-sm text-slate-500 dark:text-slate-400">
                Guarda los datos básicos del tutor para asociar pacientes y citas.
            </p>
        </section>

        <section class="vet-app-card p-6">
            <form action="{{ route('clientes.store') }}" method="POST" class="space-y-6">
                @csrf

                <div class="grid grid-cols-1 gap-5 md:grid-cols-2">
                    <div class="md:col-span-2">
                        <label for="nombre" class="vet-app-label">Nombre completo <span class="text-rose-500">*</span></label>
                        <div class="vet-app-input-wrap relative mt-2">
                            <svg class="vet-app-input-icon" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true">
                                <path d="M12 12.25a4.5 4.5 0 1 0 0-9 4.5 4.5 0 0 0 0 9Zm0 1.5c-3.04 0-7.25 1.54-7.25 4.5v1.5h14.5v-1.5c0-2.96-4.21-4.5-7.25-4.5Z" />
                            </svg>
                            <input id="nombre" type="text" name="nombre" value="{{ old('nombre') }}"
                                class="vet-app-input pl-12 @error('nombre') border-rose-300 dark:border-rose-400/60 @enderror"
                                placeholder="Nombre del cliente" required>
                        </div>
                        @error('nombre')
                            <p class="mt-2 text-sm text-rose-500 dark:text-rose-300">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="email" class="vet-app-label">Correo electrónico <span class="text-rose-500">*</span></label>
                        <div class="vet-app-input-wrap relative mt-2">
                            <svg class="vet-app-input-icon" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true">
                                <path d="M4.5 5.25h15A2.25 2.25 0 0 1 21.75 7.5v9a2.25 2.25 0 0 1-2.25 2.25h-15A2.25 2.25 0 0 1 2.25 16.5v-9A2.25 2.25 0 0 1 4.5 5.25Zm0 1.5a.75.75 0 0 0-.75.75v.33l8.25 4.95 8.25-4.95V7.5a.75.75 0 0 0-.75-.75h-15Zm15.75 2.83-7.86 4.72a.75.75 0 0 1-.78 0L3.75 9.58v6.92c0 .41.34.75.75.75h15c.41 0 .75-.34.75-.75V9.58Z" />
                            </svg>
                            <input id="email" type="email" name="email" value="{{ old('email') }}"
                                class="vet-app-input pl-12 dark:[color-scheme:dark] @error('email') border-rose-300 dark:border-rose-400/60 @enderror"
                                placeholder="nombre@correo.cl" required>
                        </div>
                        @error('email')
                            <p class="mt-2 text-sm text-rose-500 dark:text-rose-300">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="telefono" class="vet-app-label">Teléfono</label>
                        <div class="vet-app-input-wrap relative mt-2">
                            <svg class="vet-app-input-icon" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true">
                                <path d="M6.62 10.79c1.44 2.83 3.76 5.14 6.59 6.59l2.2-2.2c.27-.27.67-.36 1.02-.24 1.12.37 2.33.57 3.57.57.55 0 1 .45 1 1V20c0 .55-.45 1-1 1-9.39 0-17-7.61-17-17 0-.55.45-1 1-1h3.5c.55 0 1 .45 1 1 0 1.25.2 2.45.57 3.57.11.35.03.74-.25 1.02l-2.2 2.2Z" />
                            </svg>
                            <input id="telefono" type="text" name="telefono" value="{{ old('telefono') }}"
                                class="vet-app-input pl-12" placeholder="+56 9 1234 5678">
                        </div>
                    </div>

                    <div class="md:col-span-2">
                        <label for="direccion" class="vet-app-label">Dirección</label>
                        <div class="vet-app-input-wrap relative mt-2">
                            <svg class="vet-app-input-icon" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true">
                                <path d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7Zm0 9.5c-1.38 0-2.5-1.12-2.5-2.5s1.12-2.5 2.5-2.5 2.5 1.12 2.5 2.5-1.12 2.5-2.5 2.5Z" />
                            </svg>
                            <input id="direccion" type="text" name="direccion" value="{{ old('direccion') }}"
                                class="vet-app-input pl-12" placeholder="Av. Ejemplo 123, Ciudad">
                        </div>
                    </div>
                </div>

                <div class="flex flex-col-reverse gap-3 border-t border-slate-100 pt-5 dark:border-white/10 sm:flex-row sm:justify-end">
                    <a href="{{ route('clientes.index') }}" class="vet-app-button-secondary">
                        Cancelar
                    </a>
                    <button type="submit" class="vet-app-button-primary">
                        Guardar cliente
                    </button>
                </div>
            </form>
        </section>
    </div>
</x-app-layout>
