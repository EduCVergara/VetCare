<x-app-layout>
    <x-slot name="header">Pacientes</x-slot>

    <div class="space-y-6">
        <section class="vet-dashboard-surface p-5">
            <div class="flex flex-col gap-4 lg:flex-row lg:items-end lg:justify-between">
                <div>
                    <p class="text-sm font-semibold text-teal-700 dark:text-teal-300">Gestion de pacientes</p>
                    <h2 class="mt-2 text-3xl font-semibold text-slate-950 dark:text-white">Pacientes registrados</h2>
                    <p class="mt-2 text-sm text-slate-500 dark:text-slate-400">
                        Revisa mascotas, tutores y datos clinicos basicos en un solo lugar.
                    </p>
                </div>

                <a href="{{ route('pacientes.create') }}" class="vet-app-button-primary">
                    <svg class="h-4 w-4" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true">
                        <path d="M11 5a1 1 0 1 1 2 0v6h6a1 1 0 1 1 0 2h-6v6a1 1 0 1 1-2 0v-6H5a1 1 0 1 1 0-2h6V5Z" />
                    </svg>
                    Nuevo paciente
                </a>
            </div>

            <div class="vet-app-input-wrap relative mt-5 max-w-md">
                <svg class="vet-app-input-icon" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                    <path d="M15.5 14h-.79l-.28-.27A6.47 6.47 0 0 0 16 9.5 6.5 6.5 0 1 0 9.5 16c1.61 0 3.09-.59 4.23-1.57l.27.28v.79l5 4.99L20.49 19l-4.99-5Zm-6 0C7.01 14 5 11.99 5 9.5S7.01 5 9.5 5 14 7.01 14 9.5 11.99 14 9.5 14Z" />
                </svg>
                <input type="text" placeholder="Buscar por paciente o tutor" id="buscar-pacientes"
                    class="vet-app-input pl-12">
            </div>
        </section>

        @php
            $badgeEspecie = [
                'Perro' => 'bg-sky-50 text-sky-600 dark:bg-sky-400/10 dark:text-sky-300',
                'Gato' => 'bg-rose-50 text-rose-500 dark:bg-rose-400/10 dark:text-rose-300',
                'Ave' => 'bg-emerald-50 text-emerald-600 dark:bg-emerald-400/10 dark:text-emerald-300',
                'Otro' => 'bg-slate-100 text-slate-500 dark:bg-white/[0.06] dark:text-slate-300',
            ];
        @endphp

        <section id="lista-pacientes" class="grid grid-cols-1 gap-4 md:grid-cols-2 xl:grid-cols-3">
            @forelse($pacientes as $paciente)
                <article class="paciente-card vet-app-card vet-app-card-hover p-5"
                    data-nombre="{{ strtolower($paciente->nombre) }}"
                    data-dueno="{{ strtolower($paciente->cliente->nombre) }}">
                    <div class="mb-5 flex items-start justify-between gap-3">
                        <div class="min-w-0">
                            <div class="flex items-center gap-3">
                                <div class="flex h-11 w-11 shrink-0 items-center justify-center rounded-2xl bg-teal-50 text-sm font-semibold text-teal-700 dark:bg-teal-300/10 dark:text-teal-200">
                                    {{ strtoupper(substr($paciente->nombre, 0, 2)) }}
                                </div>
                                <div class="min-w-0">
                                    <div class="flex items-center gap-2">
                                        <h3 class="truncate text-sm font-semibold text-slate-900 dark:text-white">{{ $paciente->nombre }}</h3>
                                        <span class="shrink-0 rounded-full px-2.5 py-1 text-xs font-semibold {{ $badgeEspecie[$paciente->especie] ?? $badgeEspecie['Otro'] }}">
                                            {{ $paciente->especie }}
                                        </span>
                                    </div>
                                    <p class="mt-0.5 truncate text-xs text-slate-400 dark:text-slate-500">
                                        {{ $paciente->raza ?? 'Raza no especificada' }}
                                    </p>
                                </div>
                            </div>
                        </div>

                        <div class="flex shrink-0 gap-1">
                            <a href="{{ route('pacientes.edit', $paciente) }}" class="vet-app-icon-button" title="Editar paciente">
                                <svg class="h-4 w-4" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                    <path d="M3 17.25V21h3.75L17.81 9.94l-3.75-3.75L3 17.25ZM20.71 7.04a1 1 0 0 0 0-1.41l-2.34-2.34a1 1 0 0 0-1.41 0l-1.83 1.83 3.75 3.75 1.83-1.83Z" />
                                </svg>
                            </a>
                            <form action="{{ route('pacientes.destroy', $paciente) }}" method="POST"
                                data-confirm="Eliminar a {{ $paciente->nombre }}?"
                                data-confirm-text="Esta accion no se puede deshacer.">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="vet-app-danger-button" title="Eliminar paciente">
                                    <svg class="h-4 w-4" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                        <path d="M6 19c0 1.1.9 2 2 2h8c1.1 0 2-.9 2-2V7H6v12ZM19 4h-3.5l-1-1h-5l-1 1H5v2h14V4Z" />
                                    </svg>
                                </button>
                            </form>
                        </div>
                    </div>

                    <div class="grid grid-cols-2 gap-3">
                        <div class="rounded-2xl bg-slate-50 p-3 dark:bg-white/[0.045]">
                            <p class="text-xs font-semibold text-teal-700 dark:text-teal-300">Edad</p>
                            <p class="mt-1 text-sm font-semibold text-slate-900 dark:text-white">
                                {{ $paciente->edad ? $paciente->edad . ' ' . ($paciente->edad === 1 ? 'ano' : 'anos') : '-' }}
                            </p>
                        </div>
                        <div class="rounded-2xl bg-slate-50 p-3 dark:bg-white/[0.045]">
                            <p class="text-xs font-semibold text-teal-700 dark:text-teal-300">Peso</p>
                            <p class="mt-1 text-sm font-semibold text-slate-900 dark:text-white">
                                {{ $paciente->peso ? $paciente->peso . ' kg' : '-' }}
                            </p>
                        </div>
                    </div>

                    <div class="mt-5 space-y-2.5 text-sm text-slate-600 dark:text-slate-300">
                        <div class="flex items-center gap-2.5">
                            <span class="flex h-8 w-8 shrink-0 items-center justify-center rounded-xl bg-teal-50 text-teal-600 dark:bg-teal-400/10 dark:text-teal-300">
                                <svg class="h-4 w-4" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                    <path d="M12 12.25a4.5 4.5 0 1 0 0-9 4.5 4.5 0 0 0 0 9Zm0 1.5c-3.04 0-7.25 1.54-7.25 4.5v1.5h14.5v-1.5c0-2.96-4.21-4.5-7.25-4.5Z" />
                                </svg>
                            </span>
                            <span class="min-w-0 truncate">{{ $paciente->cliente->nombre }}</span>
                        </div>

                        @if($paciente->microchip)
                            <div class="flex items-center gap-2.5">
                                <span class="flex h-8 w-8 shrink-0 items-center justify-center rounded-xl bg-sky-50 text-sky-600 dark:bg-sky-400/10 dark:text-sky-300">
                                    <svg class="h-4 w-4" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                        <path d="M7 7h10v10H7V7Zm2 2v6h6V9H9Zm11 1h2v4h-2v-4ZM2 10h2v4H2v-4Zm8-8h4v2h-4V2Zm0 18h4v2h-4v-2ZM5 5h14v14H5V5Z" />
                                    </svg>
                                </span>
                                <span class="min-w-0 truncate font-mono text-xs">{{ $paciente->microchip }}</span>
                            </div>
                        @endif

                        @if($paciente->ultima_visita)
                            <div class="flex items-center gap-2.5">
                                <span class="flex h-8 w-8 shrink-0 items-center justify-center rounded-xl bg-amber-50 text-amber-600 dark:bg-amber-400/10 dark:text-amber-300">
                                    <svg class="h-4 w-4" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                        <path d="M17 12h-5v5h5v-5ZM16 1v2H8V1H6v2H5c-1.11 0-1.99.9-1.99 2L3 19c0 1.1.89 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2h-1V1h-2Zm3 18H5V8h14v11Z" />
                                    </svg>
                                </span>
                                <span>Ultima visita: {{ $paciente->ultima_visita->translatedFormat('d/m/Y') }}</span>
                            </div>
                        @endif
                    </div>

                    @if(Route::has('historial.index'))
                        <div class="mt-5 border-t border-slate-100 pt-4 dark:border-white/10">
                            <a href="{{ route('historial.index', ['paciente' => $paciente->id]) }}" class="vet-app-button-secondary w-full">
                                Ver historial medico
                            </a>
                        </div>
                    @endif
                </article>
            @empty
                <div class="col-span-full vet-empty-state">
                    No hay pacientes registrados aun.
                </div>
            @endforelse
        </section>
    </div>

    <x-slot name="scripts">
        @vite('resources/js/pacientes.js')
    </x-slot>
</x-app-layout>
