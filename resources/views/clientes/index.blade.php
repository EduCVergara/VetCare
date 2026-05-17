<x-app-layout>
    <x-slot name="header">Clientes</x-slot>

    <div class="space-y-6">
        <section class="vet-dashboard-surface p-5">
            <div class="flex flex-col gap-4 lg:flex-row lg:items-end lg:justify-between">
                <div>
                    <p class="text-sm font-semibold text-teal-700 dark:text-teal-300">Gestión de clientes</p>
                    <h2 class="mt-2 text-3xl font-semibold text-slate-950 dark:text-white">Clientes registrados</h2>
                    <p class="mt-2 text-sm text-slate-500 dark:text-slate-400">
                        Busca, edita o agrega tutores para mantener sus datos al día.
                    </p>
                </div>

                <a href="{{ route('clientes.create') }}" class="vet-app-button-primary">
                    <svg class="h-4 w-4" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true">
                        <path d="M11 5a1 1 0 1 1 2 0v6h6a1 1 0 1 1 0 2h-6v6a1 1 0 1 1-2 0v-6H5a1 1 0 1 1 0-2h6V5Z" />
                    </svg>
                    Nuevo cliente
                </a>
            </div>

            <div class="vet-app-input-wrap relative mt-5 max-w-md">
                <svg class="vet-app-input-icon" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                    <path d="M15.5 14h-.79l-.28-.27A6.47 6.47 0 0 0 16 9.5 6.5 6.5 0 1 0 9.5 16c1.61 0 3.09-.59 4.23-1.57l.27.28v.79l5 4.99L20.49 19l-4.99-5Zm-6 0C7.01 14 5 11.99 5 9.5S7.01 5 9.5 5 14 7.01 14 9.5 11.99 14 9.5 14Z" />
                </svg>
                <input type="text" placeholder="Buscar por nombre o correo" id="buscar-clientes"
                    class="vet-app-input pl-12">
            </div>
        </section>

        <section id="lista-clientes" class="grid grid-cols-1 gap-4 md:grid-cols-2 xl:grid-cols-3">
            @forelse($clientes as $cliente)
                <article class="cliente-card vet-app-card vet-app-card-hover p-5"
                    data-nombre="{{ strtolower($cliente->nombre) }}" data-email="{{ strtolower($cliente->email) }}">
                    <div class="mb-5 flex items-start justify-between gap-3">
                        <div class="min-w-0">
                            <div class="flex items-center gap-3">
                                <div class="flex h-11 w-11 shrink-0 items-center justify-center rounded-2xl bg-teal-50 text-sm font-semibold text-teal-700 dark:bg-teal-300/10 dark:text-teal-200">
                                    {{ strtoupper(substr($cliente->nombre, 0, 2)) }}
                                </div>
                                <div class="min-w-0">
                                    <h3 class="truncate text-sm font-semibold text-slate-900 dark:text-white">{{ $cliente->nombre }}</h3>
                                    <p class="mt-0.5 text-xs text-slate-400 dark:text-slate-500">Cliente desde {{ $cliente->created_at->translatedFormat('d/m/Y') }}</p>
                                </div>
                            </div>
                        </div>

                        <div class="flex shrink-0 gap-1">
                            <a href="{{ route('clientes.edit', $cliente) }}" class="vet-app-icon-button" title="Editar cliente">
                                <svg class="h-4 w-4" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                    <path d="M3 17.25V21h3.75L17.81 9.94l-3.75-3.75L3 17.25ZM20.71 7.04a1 1 0 0 0 0-1.41l-2.34-2.34a1 1 0 0 0-1.41 0l-1.83 1.83 3.75 3.75 1.83-1.83Z" />
                                </svg>
                            </a>
                            <form action="{{ route('clientes.destroy', $cliente) }}" method="POST"
                                data-confirm="¿Eliminar a {{ $cliente->nombre }}?"
                                data-confirm-text="También se eliminarán sus pacientes y citas.">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="vet-app-danger-button" title="Eliminar cliente">
                                    <svg class="h-4 w-4" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                        <path d="M6 19c0 1.1.9 2 2 2h8c1.1 0 2-.9 2-2V7H6v12ZM19 4h-3.5l-1-1h-5l-1 1H5v2h14V4Z" />
                                    </svg>
                                </button>
                            </form>
                        </div>
                    </div>

                    <div class="space-y-2.5">
                        <div class="flex items-center gap-2.5 text-sm text-slate-600 dark:text-slate-300">
                            <span class="flex h-8 w-8 shrink-0 items-center justify-center rounded-xl bg-sky-50 text-sky-600 dark:bg-sky-400/10 dark:text-sky-300">
                                <svg class="h-4 w-4" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                    <path d="M20 4H4c-1.1 0-2 .9-2 2v12c0 1.1.9 2 2 2h16c1.1 0 2-.9 2-2V6c0-1.1-.9-2-2-2Zm0 4-8 5-8-5V6l8 5 8-5v2Z" />
                                </svg>
                            </span>
                            <span class="min-w-0 truncate">{{ $cliente->email }}</span>
                        </div>
                        <div class="flex items-center gap-2.5 text-sm text-slate-600 dark:text-slate-300">
                            <span class="flex h-8 w-8 shrink-0 items-center justify-center rounded-xl bg-teal-50 text-teal-600 dark:bg-teal-400/10 dark:text-teal-300">
                                <svg class="h-4 w-4" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                    <path d="M6.62 10.79c1.44 2.83 3.76 5.14 6.59 6.59l2.2-2.2c.27-.27.67-.36 1.02-.24 1.12.37 2.33.57 3.57.57.55 0 1 .45 1 1V20c0 .55-.45 1-1 1-9.39 0-17-7.61-17-17 0-.55.45-1 1-1h3.5c.55 0 1 .45 1 1 0 1.25.2 2.45.57 3.57.11.35.03.74-.25 1.02l-2.2 2.2Z" />
                                </svg>
                            </span>
                            <span class="min-w-0 truncate">{{ $cliente->telefono ?? 'Sin teléfono' }}</span>
                        </div>
                        <div class="flex items-center gap-2.5 text-sm text-slate-600 dark:text-slate-300">
                            <span class="flex h-8 w-8 shrink-0 items-center justify-center rounded-xl bg-rose-50 text-rose-500 dark:bg-rose-400/10 dark:text-rose-300">
                                <svg class="h-4 w-4" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                    <path d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7Zm0 9.5c-1.38 0-2.5-1.12-2.5-2.5s1.12-2.5 2.5-2.5 2.5 1.12 2.5 2.5-1.12 2.5-2.5 2.5Z" />
                                </svg>
                            </span>
                            <span class="min-w-0 truncate">{{ $cliente->direccion ?? 'Sin dirección' }}</span>
                        </div>
                    </div>

                    <div class="mt-5 flex items-center justify-between border-t border-slate-100 pt-4 text-sm dark:border-white/10">
                        <span class="text-slate-500 dark:text-slate-400">
                            {{ $cliente->pacientes_count === 1 ? 'Mascota registrada' : 'Mascotas registradas' }}
                        </span>
                        <span class="rounded-full bg-teal-50 px-3 py-1 text-xs font-semibold text-teal-700 dark:bg-teal-300/10 dark:text-teal-200">
                            {{ $cliente->pacientes_count }}
                        </span>
                    </div>
                </article>
            @empty
                <div class="col-span-full vet-empty-state">
                    No hay clientes registrados aún.
                </div>
            @endforelse
        </section>
    </div>

    <x-slot name="scripts">
        @vite('resources/js/clientes.js')
    </x-slot>
</x-app-layout>
