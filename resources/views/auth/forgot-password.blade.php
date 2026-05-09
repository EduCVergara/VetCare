<x-guest-layout>
    <h2 class="text-lg font-medium text-gray-700 mb-3">Recuperar contraseña</h2>

    <div class="mb-4 text-sm text-gray-500">
        Ingresa tu correo electrónico y te enviaremos un enlace para crear una nueva contraseña.
    </div>

    <x-auth-session-status class="mb-4 p-3 bg-green-50 text-green-700 rounded-lg text-sm" :status="session('status')" />

    <form method="POST" action="{{ route('password.email') }}">
        @csrf

        <div>
            <x-input-label for="email" :value="__('Correo electrónico')" />
            <x-text-input id="email"
                class="block mt-1 w-full rounded-lg border-gray-200 focus:border-purple-400 focus:ring-purple-400"
                type="email" name="email" :value="old('email')" required autofocus />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div class="flex items-center justify-between mt-6">
            <a href="{{ route('login') }}" class="text-sm text-gray-500 hover:text-gray-700 transition">
                Volver al inicio de sesión
            </a>

            <button type="submit" class="px-4 py-2.5 rounded-lg text-white text-sm font-medium transition"
                style="background: linear-gradient(135deg, #7F77DD, #534AB7)">
                Enviar enlace
            </button>
        </div>
    </form>
</x-guest-layout>
