<x-app-layout>
    <x-slot name="header">Editar Usuario</x-slot>

    <div class="max-w-3xl">
        <div class="bg-white rounded-xl border border-gray-100 p-6">
            <form action="{{ route('usuarios.update', $usuario) }}" method="POST" class="space-y-5">
                @csrf
                @method('PUT')

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div class="md:col-span-2">
                        <label class="block text-xs text-gray-400 mb-1.5">Nombre completo <span
                                class="text-red-400">*</span></label>
                        <input type="text" name="nombre" value="{{ old('nombre', $usuario->nombre) }}"
                            class="w-full border border-gray-200 rounded-lg px-3 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-purple-300 @error('nombre') border-red-300 @enderror"
                            required>
                        @error('nombre')
                            <p class="text-red-400 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-xs text-gray-400 mb-1.5">Email <span
                                class="text-red-400">*</span></label>
                        <input type="email" name="email" value="{{ old('email', $usuario->email) }}"
                            class="w-full border border-gray-200 rounded-lg px-3 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-purple-300 @error('email') border-red-300 @enderror"
                            required>
                        @error('email')
                            <p class="text-red-400 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-xs text-gray-400 mb-1.5">Teléfono</label>
                        <input type="text" name="telefono" value="{{ old('telefono', $usuario->telefono) }}"
                            class="w-full border border-gray-200 rounded-lg px-3 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-purple-300 @error('telefono') border-red-300 @enderror"
                            placeholder="+56 9 1234 5678">
                        @error('telefono')
                            <p class="text-red-400 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-xs text-gray-400 mb-1.5">Cargo</label>
                        <input type="text" name="cargo" value="{{ old('cargo', $usuario->cargo) }}"
                            class="w-full border border-gray-200 rounded-lg px-3 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-purple-300 @error('cargo') border-red-300 @enderror"
                            placeholder="Ej. Médico veterinario">
                        @error('cargo')
                            <p class="text-red-400 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-xs text-gray-400 mb-1.5">Rol <span
                                class="text-red-400">*</span></label>
                        <select name="rol"
                            class="w-full border border-gray-200 rounded-lg px-3 py-2.5 text-sm bg-white focus:outline-none focus:ring-2 focus:ring-purple-300 @error('rol') border-red-300 @enderror"
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

                    <div class="md:col-span-2 pt-2 border-t border-gray-100">
                        <p class="text-sm font-medium text-gray-700 mb-1">Actualizar contraseña</p>
                        <p class="text-xs text-gray-400 mb-4">Déjala en blanco si no quieres cambiarla.</p>
                    </div>

                    <div>
                        <label class="block text-xs text-gray-400 mb-1.5">Nueva contraseña</label>
                        <input type="password" name="password"
                            class="w-full border border-gray-200 rounded-lg px-3 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-purple-300 @error('password') border-red-300 @enderror">
                        @error('password')
                            <p class="text-red-400 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-xs text-gray-400 mb-1.5">Confirmar contraseña</label>
                        <input type="password" name="password_confirmation"
                            class="w-full border border-gray-200 rounded-lg px-3 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-purple-300">
                    </div>
                </div>

                <div class="flex gap-3 pt-2">
                    <button type="submit" class="text-white text-sm font-medium px-5 py-2.5 rounded-lg transition"
                        style="background: linear-gradient(135deg, #7F77DD, #534AB7)">
                        Actualizar Usuario
                    </button>
                    <a href="{{ route('usuarios.index') }}"
                        class="border border-gray-200 text-gray-400 text-sm px-5 py-2.5 rounded-lg hover:bg-gray-50 transition">
                        Cancelar
                    </a>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
