<x-app-layout>
    <x-slot name="header">Gestión de Usuarios</x-slot>

    @php
        $badgeRoles = [
            'admin' => 'bg-purple-50 text-purple-700 dark:bg-violet-500/15 dark:text-violet-300',
            'veterinario' => 'bg-teal-50 text-teal-700 dark:bg-teal-500/15 dark:text-teal-300',
            'recepcionista' => 'bg-amber-50 text-amber-700 dark:bg-amber-500/15 dark:text-amber-300',
            'visor' => 'bg-gray-100 text-gray-600 dark:bg-slate-800 dark:text-slate-300',
        ];
    @endphp

    <div class="flex justify-between items-center mb-6 gap-4">
        <div class="relative w-full max-w-xs">
            <svg class="absolute left-3 top-1/2 -translate-y-1/2 w-4 h-4 text-gray-300 dark:text-slate-500" fill="currentColor" viewBox="0 0 24 24">
                <path d="M15.5 14h-.79l-.28-.27A6.471 6.471 0 0 0 16 9.5 6.5 6.5 0 1 0 9.5 16c1.61 0 3.09-.59 4.23-1.57l.27.28v.79l5 4.99L20.49 19l-4.99-5zm-6 0C7.01 14 5 11.99 5 9.5S7.01 5 9.5 5 14 7.01 14 9.5 11.99 14 9.5 14z" />
            </svg>
            <input type="text" id="buscar-usuarios" placeholder="Buscar usuarios..."
                class="w-full pl-9 pr-4 py-2 text-sm border border-gray-200 rounded-lg bg-gray-50 focus:outline-none focus:ring-2 focus:ring-purple-300 dark:bg-slate-900 dark:border-slate-700 dark:text-slate-100">
        </div>

        <a href="{{ route('usuarios.create') }}" class="text-white text-sm font-medium px-4 py-2 rounded-lg transition" style="background: linear-gradient(135deg, #7F77DD, #534AB7)">
            + Nuevo Usuario
        </a>
    </div>

    <div id="lista-usuarios" class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-4">
        @forelse($usuarios as $usuario)
            <div class="usuario-card bg-white rounded-xl border border-gray-100 p-5 dark:bg-slate-900 dark:border-slate-800"
                data-nombre="{{ strtolower($usuario->nombre) }}"
                data-email="{{ strtolower($usuario->email) }}"
                data-cargo="{{ strtolower($usuario->cargo ?? '') }}"
                data-rol="{{ strtolower($usuario->rol) }}">
                <div class="flex justify-between items-start gap-3 mb-4">
                    <div class="min-w-0 flex-1">
                        <div class="flex items-center gap-2 flex-wrap mb-1">
                            <span class="font-medium text-gray-800 dark:text-slate-100">{{ $usuario->nombre }}</span>

                            @if($usuario->id === auth()->id())
                                <span class="text-[11px] px-2 py-0.5 rounded-full bg-blue-50 text-blue-600 font-medium dark:bg-blue-500/15 dark:text-blue-300">
                                    Tu cuenta
                                </span>
                            @endif

                            <span class="text-[11px] px-2 py-0.5 rounded-full font-medium capitalize {{ $badgeRoles[$usuario->rol] ?? 'bg-gray-100 text-gray-600 dark:bg-slate-800 dark:text-slate-300' }}">
                                {{ $usuario->rol }}
                            </span>
                        </div>

                        <p class="text-xs text-gray-400 dark:text-slate-400">Usuario desde {{ $usuario->created_at->translatedFormat('d/m/Y') }}</p>
                    </div>

                    <div class="flex gap-2 flex-shrink-0">
                        <a href="{{ route('usuarios.edit', $usuario) }}" class="text-gray-300 hover:text-gray-500 transition dark:text-slate-500 dark:hover:text-slate-300" title="Editar usuario">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M3 17.25V21h3.75L17.81 9.94l-3.75-3.75L3 17.25zM20.71 7.04a1 1 0 0 0 0-1.41l-2.34-2.34a1 1 0 0 0-1.41 0l-1.83 1.83 3.75 3.75 1.83-1.83z" />
                            </svg>
                        </a>
                        <form action="{{ route('usuarios.destroy', $usuario) }}" method="POST"
                            data-confirm="¿Eliminar a {{ $usuario->nombre }}?"
                            data-confirm-text="{{ $usuario->id === auth()->id() ? 'No puedes eliminar tu propia cuenta.' : 'Esta acción no se puede deshacer.' }}">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-gray-300 hover:text-red-400 transition dark:text-slate-500 dark:hover:text-red-400" title="Eliminar usuario" @disabled($usuario->id === auth()->id())>
                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M6 19c0 1.1.9 2 2 2h8c1.1 0 2-.9 2-2V7H6v12zM19 4h-3.5l-1-1h-5l-1 1H5v2h14V4z" />
                                </svg>
                            </button>
                        </form>
                    </div>
                </div>

                <div class="space-y-2.5 mb-4">
                    <div class="flex items-center gap-2 text-sm text-gray-500 dark:text-slate-300">
                        <svg class="w-3.5 h-3.5 text-purple-300 flex-shrink-0" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M20 4H4c-1.1 0-2 .9-2 2v12c0 1.1.9 2 2 2h16c1.1 0 2-.9 2-2V6c0-1.1-.9-2-2-2zm0 4-8 5-8-5V6l8 5 8-5v2z" />
                        </svg>
                        <span class="truncate">{{ $usuario->email }}</span>
                    </div>

                    <div class="flex items-center gap-2 text-sm text-gray-500 dark:text-slate-300">
                        <svg class="w-3.5 h-3.5 text-teal-300 flex-shrink-0" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M6.62 10.79c1.44 2.83 3.76 5.14 6.59 6.59l2.2-2.2c.27-.27.67-.36 1.02-.24 1.12.37 2.33.57 3.57.57.55 0 1 .45 1 1V20c0 .55-.45 1-1 1-9.39 0-17-7.61-17-17 0-.55.45-1 1-1h3.5c.55 0 1 .45 1 1 0 1.25.2 2.45.57 3.57.11.35.03.74-.25 1.02l-2.2 2.2z" />
                        </svg>
                        {{ $usuario->telefono ?: 'Sin teléfono registrado' }}
                    </div>

                    <div class="flex items-center gap-2 text-sm text-gray-500 dark:text-slate-300">
                        <svg class="w-3.5 h-3.5 text-amber-300 flex-shrink-0" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M14 6V4h-4v2H5v14h14V6h-5zm-2 11c-1.66 0-3-1.34-3-3s1.34-3 3-3 3 1.34 3 3-1.34 3-3 3z" />
                        </svg>
                        {{ $usuario->cargo ?: 'Cargo no especificado' }}
                    </div>
                </div>

                <div class="pt-3 border-t border-gray-50 dark:border-slate-800 flex justify-between items-center text-sm">
                    <span class="text-gray-400 dark:text-slate-400">{{ $usuario->email_verified_at ? 'Correo verificado' : 'Pendiente de verificación' }}</span>
                    <span class="font-medium {{ $usuario->email_verified_at ? 'text-teal-600 dark:text-teal-300' : 'text-amber-600 dark:text-amber-300' }}">
                        {{ $usuario->email_verified_at ? 'Verificado' : 'Pendiente' }}
                    </span>
                </div>
            </div>
        @empty
            <div class="col-span-3 text-center py-16 text-gray-300 dark:text-slate-500">
                <svg class="w-12 h-12 mx-auto mb-3 text-gray-200 dark:text-slate-700" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M16 11c1.66 0 2.99-1.34 2.99-3S17.66 5 16 5c-1.66 0-3 1.34-3 3s1.34 3 3 3zm-8 0c1.66 0 2.99-1.34 2.99-3S9.66 5 8 5C6.34 5 5 6.34 5 8s1.34 3 3 3zm0 2c-2.33 0-7 1.17-7 3.5V19h14v-2.5c0-2.33-4.67-3.5-7-3.5zm8 0c-.29 0-.62.02-.97.05 1.16.84 1.97 1.97 1.97 3.45V19h6v-2.5c0-2.33-4.67-3.5-7-3.5z" />
                </svg>
                No hay usuarios registrados aún.
            </div>
        @endforelse
    </div>

    <x-slot name="scripts">
        @vite('resources/js/usuarios.js')
    </x-slot>
</x-app-layout>
