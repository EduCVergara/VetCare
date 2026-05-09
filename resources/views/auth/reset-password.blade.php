<x-guest-layout>
    <h2 class="text-lg font-medium text-gray-700 mb-6">Nueva contraseña</h2>

    <form method="POST" action="{{ route('password.store') }}">
        @csrf

        <input type="hidden" name="token" value="{{ $request->route('token') }}">

        <div>
            <x-input-label for="email" :value="__('Correo electrónico')" />
            <x-text-input id="email"
                class="block mt-1 w-full rounded-lg border-gray-200 focus:border-purple-400 focus:ring-purple-400"
                type="email" name="email" :value="old('email', $request->email)" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div class="mt-4">
            <x-input-label for="password" :value="__('Nueva contraseña')" />
            <x-text-input id="password"
                class="block mt-1 w-full rounded-lg border-gray-200 focus:border-purple-400 focus:ring-purple-400"
                type="password" name="password" required autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Confirmar contraseña')" />
            <x-text-input id="password_confirmation"
                class="block mt-1 w-full rounded-lg border-gray-200 focus:border-purple-400 focus:ring-purple-400"
                type="password" name="password_confirmation" required autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-6">
            <button type="submit" class="px-4 py-2.5 rounded-lg text-white text-sm font-medium transition"
                style="background: linear-gradient(135deg, #7F77DD, #534AB7)">
                Guardar contraseña
            </button>
        </div>
    </form>
</x-guest-layout>
