<x-app-layout>
    <x-slot name="header">Editar Usuario</x-slot>

    <div class="max-w-3xl">
        <div class="bg-white rounded-xl border border-gray-100 p-6 dark:bg-slate-900 dark:border-slate-800">
            <form action="{{ route('usuarios.update', $usuario) }}" method="POST" class="space-y-5">
                @csrf
                @method('PUT')

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div class="md:col-span-2">
                        <label class="block text-xs text-gray-400 mb-1.5 dark:text-slate-400">Nombre completo <span
                                class="text-red-400">*</span></label>
                        <input type="text" name="nombre" value="{{ old('nombre', $usuario->nombre) }}"
                            class="w-full border border-gray-200 rounded-lg px-3 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-purple-300 dark:bg-slate-800 dark:border-slate-600 dark:text-slate-100 @error('nombre') border-red-300 @enderror"
                            required>
                        @error('nombre')
                            <p class="text-red-400 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-xs text-gray-400 mb-1.5 dark:text-slate-400">Email <span
                                class="text-red-400">*</span></label>
                        <input type="email" name="email" value="{{ old('email', $usuario->email) }}"
                            class="w-full border border-gray-200 rounded-lg px-3 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-purple-300 dark:bg-slate-800 dark:border-slate-600 dark:text-slate-100 @error('email') border-red-300 @enderror"
                            required>
                        @error('email')
                            <p class="text-red-400 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-xs text-gray-400 mb-1.5 dark:text-slate-400">Teléfono</label>
                        <input type="text" name="telefono" value="{{ old('telefono', $usuario->telefono) }}"
                            class="w-full border border-gray-200 rounded-lg px-3 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-purple-300 dark:bg-slate-800 dark:border-slate-600 dark:text-slate-100 @error('telefono') border-red-300 @enderror"
                            placeholder="+56 9 1234 5678">
                        @error('telefono')
                            <p class="text-red-400 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-xs text-gray-400 mb-1.5 dark:text-slate-400">Cargo</label>
                        <input type="text" name="cargo" value="{{ old('cargo', $usuario->cargo) }}"
                            class="w-full border border-gray-200 rounded-lg px-3 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-purple-300 dark:bg-slate-800 dark:border-slate-600 dark:text-slate-100 @error('cargo') border-red-300 @enderror"
                            placeholder="Ej. Médico veterinario">
                        @error('cargo')
                            <p class="text-red-400 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-xs text-gray-400 mb-1.5 dark:text-slate-400">Rol <span
                                class="text-red-400">*</span></label>
                        <select name="rol" id="sel-rol"
                            class="w-full rounded-lg text-sm @error('rol') is-invalid @enderror"
                            required>
                            <option value="admin" @selected(old('rol', $usuario->rol) === 'admin')>Administrador</option>
                            <option value="veterinario" @selected(old('rol', $usuario->rol) === 'veterinario')>Veterinario</option>
                            <option value="recepcionista" @selected(old('rol', $usuario->rol) === 'recepcionista')>Recepcionista</option>
                            <option value="visor" @selected(old('rol', $usuario->rol) === 'visor')>Visor</option>
                        </select>
                        @error('rol')
                            <p class="text-red-400 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="md:col-span-2 pt-2 border-t border-gray-100 dark:border-slate-800">
                        <p class="text-sm font-medium text-gray-700 mb-1 dark:text-slate-100">Actualizar contraseña</p>
                        <p class="text-xs text-gray-400 mb-4 dark:text-slate-400">Déjala en blanco si no quieres cambiarla.</p>
                    </div>

                    <div>
                        <label class="block text-xs text-gray-400 mb-1.5 dark:text-slate-400">Nueva contraseña</label>
                        <input type="password" name="password"
                            class="w-full border border-gray-200 rounded-lg px-3 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-purple-300 dark:bg-slate-800 dark:border-slate-600 dark:text-slate-100 @error('password') border-red-300 @enderror">
                        @error('password')
                            <p class="text-red-400 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-xs text-gray-400 mb-1.5 dark:text-slate-400">Confirmar contraseña</label>
                        <input type="password" name="password_confirmation"
                            class="w-full border border-gray-200 rounded-lg px-3 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-purple-300 dark:bg-slate-800 dark:border-slate-600 dark:text-slate-100">
                    </div>
                </div>

                <div class="flex gap-3 pt-2">
                    <button type="submit" class="text-white text-sm font-medium px-5 py-2.5 rounded-lg transition"
                        style="background: linear-gradient(135deg, #7F77DD, #534AB7)">
                        Actualizar Usuario
                    </button>
                    <a href="{{ route('usuarios.index') }}"
                        class="border border-gray-200 text-gray-400 text-sm px-5 py-2.5 rounded-lg hover:bg-gray-50 transition dark:bg-gray-600 dark:text-gray-50 dark:border-gray-400 dark:hover:bg-gray-700">
                        Cancelar
                    </a>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
