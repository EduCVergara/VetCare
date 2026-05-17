<x-app-layout>
    <x-slot name="header">Dashboard</x-slot>

    @php
        $badges = [
            'Confirmada' => 'bg-teal-50 text-teal-700 dark:bg-teal-400/10 dark:text-teal-200',
            'Pendiente' => 'bg-amber-50 text-amber-700 dark:bg-amber-400/10 dark:text-amber-200',
            'En consulta' => 'bg-violet-50 text-violet-700 dark:bg-violet-400/10 dark:text-violet-200',
            'Completada' => 'bg-sky-50 text-sky-700 dark:bg-sky-400/10 dark:text-sky-200',
            'Cancelada' => 'bg-rose-50 text-rose-700 dark:bg-rose-400/10 dark:text-rose-200',
        ];

        $stats = [
            [
                'label' => 'Clientes activos',
                'value' => $totalClientes,
                'hint' => 'Base de atención',
                'iconClass' => 'border-sky-100 bg-sky-50 text-sky-600 dark:border-sky-300/10 dark:bg-sky-400/10 dark:text-sky-300',
                'valueClass' => 'text-sky-600 dark:text-sky-300',
                'icon' => 'clientes',
            ],
            [
                'label' => 'Pacientes registrados',
                'value' => $totalPacientes,
                'hint' => 'Fichas clínicas',
                'iconClass' => 'border-teal-100 bg-teal-50 text-teal-600 dark:border-teal-300/10 dark:bg-teal-400/10 dark:text-teal-300',
                'valueClass' => 'text-teal-600 dark:text-teal-300',
                'icon' => 'pacientes',
            ],
            [
                'label' => 'Citas hoy',
                'value' => $citasHoy,
                'hint' => 'Agenda diaria',
                'iconClass' => 'border-violet-100 bg-violet-50 text-violet-600 dark:border-violet-300/10 dark:bg-violet-400/10 dark:text-violet-300',
                'valueClass' => 'text-violet-600 dark:text-violet-300',
                'icon' => 'citas',
            ],
            [
                'label' => 'Ingresos del mes',
                'value' => '$' . number_format($ingresosMes, 0, ',', '.'),
                'hint' => 'Resumen financiero',
                'iconClass' => 'border-amber-100 bg-amber-50 text-amber-600 dark:border-amber-300/10 dark:bg-amber-400/10 dark:text-amber-300',
                'valueClass' => 'text-amber-600 dark:text-amber-300',
                'icon' => 'ingresos',
            ],
        ];
    @endphp

    <div class="space-y-6">
        <section class="vet-dashboard-surface overflow-hidden p-6">
            <div class="flex flex-col gap-4 lg:flex-row lg:items-end lg:justify-between">
                <div>
                    <p class="text-sm font-semibold text-teal-700 dark:text-teal-300">Resumen clínico</p>
                    <h2 class="mt-2 text-3xl font-semibold text-slate-950 dark:text-white">Hola, {{ auth()->user()->nombre }}</h2>
                    <p class="mt-2 max-w-2xl text-sm leading-6 text-slate-500 dark:text-slate-400">
                        Una mirada rápida a la operación de hoy.
                    </p>
                </div>

                <a href="{{ route('citas.index') }}"
                    class="inline-flex h-11 items-center justify-center rounded-2xl bg-slate-950 px-4 text-sm font-semibold text-white shadow-lg shadow-slate-900/15 transition duration-300 hover:-translate-y-0.5 hover:bg-teal-700 focus:outline-none focus:ring-4 focus:ring-teal-500/20 dark:bg-teal-300 dark:text-slate-950 dark:hover:bg-emerald-200">
                    Ver agenda
                </a>
            </div>
        </section>

        <section class="grid grid-cols-1 gap-4 md:grid-cols-2 xl:grid-cols-4">
            @foreach($stats as $stat)
                <article class="vet-dashboard-card" style="animation-delay: {{ $loop->index * 70 }}ms">
                    <div class="flex items-start justify-between gap-4">
                        <div>
                            <p class="text-xs font-semibold uppercase text-slate-400 dark:text-slate-500">{{ $stat['label'] }}</p>
                            <p class="mt-3 text-3xl font-semibold {{ $stat['valueClass'] }}">{{ $stat['value'] }}</p>
                            <p class="mt-1 text-sm text-slate-500 dark:text-slate-400">{{ $stat['hint'] }}</p>
                        </div>

                        <div class="vet-dashboard-icon {{ $stat['iconClass'] }}">
                            @if($stat['icon'] === 'clientes')
                                <svg class="h-5 w-5" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                    <path d="M16 11c1.66 0 2.99-1.34 2.99-3S17.66 5 16 5c-1.66 0-3 1.34-3 3s1.34 3 3 3Zm-8 0c1.66 0 2.99-1.34 2.99-3S9.66 5 8 5 5 6.34 5 8s1.34 3 3 3Zm0 2c-2.33 0-7 1.17-7 3.5V19h14v-2.5C15 14.17 10.33 13 8 13Zm8 0c-.29 0-.62.02-.97.05 1.16.84 1.97 1.97 1.97 3.45V19h6v-2.5c0-2.33-4.67-3.5-7-3.5Z" />
                                </svg>
                            @elseif($stat['icon'] === 'pacientes')
                                <svg class="h-5 w-5" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                    <path d="M9.25 6.5a2 2 0 1 1-4 0 2 2 0 0 1 4 0Zm9.5 0a2 2 0 1 1-4 0 2 2 0 0 1 4 0ZM6.75 11.25a1.9 1.9 0 1 1-3.8 0 1.9 1.9 0 0 1 3.8 0Zm14.3 0a1.9 1.9 0 1 1-3.8 0 1.9 1.9 0 0 1 3.8 0ZM12 10.25c2.32 0 5.25 2.74 5.25 5.25 0 1.62-1.18 2.75-2.69 2.75-.9 0-1.49-.33-2.01-.62-.24-.13-.45-.25-.55-.25s-.31.12-.55.25c-.52.29-1.11.62-2.01.62-1.51 0-2.69-1.13-2.69-2.75 0-2.51 2.93-5.25 5.25-5.25Z" />
                                </svg>
                            @elseif($stat['icon'] === 'citas')
                                <svg class="h-5 w-5" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                    <path d="M17 12h-5v5h5v-5ZM16 1v2H8V1H6v2H5c-1.11 0-1.99.9-1.99 2L3 19c0 1.1.89 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2h-1V1h-2Zm3 18H5V8h14v11Z" />
                                </svg>
                            @else
                                <svg class="h-5 w-5" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                    <path d="M11.8 10.9c-2.27-.59-3-1.2-3-2.15 0-1.09 1.01-1.85 2.7-1.85 1.78 0 2.44.85 2.5 2.1h2.21c-.07-1.72-1.12-3.3-3.21-3.81V3h-3v2.16c-1.94.42-3.5 1.68-3.5 3.61 0 2.31 1.91 3.46 4.7 4.13 2.5.6 3 1.48 3 2.41 0 .69-.49 1.79-2.7 1.79-2.06 0-2.87-.92-2.98-2.1h-2.2c.12 2.19 1.76 3.42 3.68 3.83V21h3v-2.15c1.95-.37 3.5-1.5 3.5-3.55 0-2.84-2.43-3.81-4.7-4.4Z" />
                                </svg>
                            @endif
                        </div>
                    </div>
                </article>
            @endforeach
        </section>

        <section class="grid grid-cols-1 gap-4 xl:grid-cols-[minmax(0,2fr)_minmax(320px,1fr)]">
            <article class="vet-dashboard-surface p-5">
                <div class="mb-4 flex items-center justify-between gap-4">
                    <div>
                        <h3 class="vet-dashboard-section-title">Citas próximas</h3>
                        <p class="mt-1 text-xs text-slate-400 dark:text-slate-500">Agenda de las siguientes atenciones</p>
                    </div>
                    <a href="{{ route('citas.index') }}" class="vet-dashboard-link">Ver todas</a>
                </div>

                <div class="space-y-2">
                    @forelse($citasProximas as $cita)
                        <div class="vet-dashboard-row">
                            <div class="flex h-11 w-14 shrink-0 items-center justify-center rounded-2xl bg-teal-50 text-sm font-semibold text-teal-700 dark:bg-teal-400/10 dark:text-teal-200">
                                {{ $cita->fecha_hora->format('H:i') }}
                            </div>

                            <div class="min-w-0 flex-1">
                                <p class="truncate text-sm font-semibold text-slate-800 dark:text-slate-100">{{ $cita->paciente->nombre }}</p>
                                <p class="truncate text-xs text-slate-500 dark:text-slate-400">{{ $cita->cliente->nombre }}</p>
                            </div>

                            <span class="vet-status-badge {{ $badges[$cita->estado] ?? 'bg-slate-100 text-slate-600 dark:bg-white/10 dark:text-slate-300' }}">
                                {{ $cita->estado }}
                            </span>
                        </div>
                    @empty
                        <div class="vet-empty-state">
                            No hay citas próximas.
                        </div>
                    @endforelse
                </div>
            </article>

            <article class="vet-dashboard-surface p-5">
                <div class="mb-4">
                    <h3 class="vet-dashboard-section-title">Actividad reciente</h3>
                    <p class="mt-1 text-xs text-slate-400 dark:text-slate-500">Últimos movimientos del sistema</p>
                </div>

                <div class="space-y-2">
                    @forelse($actividadReciente as $actividad)
                        <div class="vet-dashboard-row items-start">
                            <div class="mt-1.5 h-2.5 w-2.5 shrink-0 rounded-full shadow-[0_0_0_5px_rgba(45,212,191,0.10)]"
                                style="background: {{ $actividad['color'] }}"></div>
                            <div class="min-w-0">
                                <p class="text-sm font-semibold text-slate-800 dark:text-slate-100">{{ $actividad['titulo'] }}</p>
                                <p class="mt-0.5 text-xs text-slate-500 dark:text-slate-400">{{ $actividad['subtitulo'] }}</p>
                                <p class="mt-1 text-xs text-slate-400 dark:text-slate-500">{{ $actividad['tiempo'] }}</p>
                            </div>
                        </div>
                    @empty
                        <div class="vet-empty-state">
                            Sin actividad reciente.
                        </div>
                    @endforelse
                </div>
            </article>
        </section>
    </div>
</x-app-layout>
