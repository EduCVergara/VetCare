<x-guest-layout>
    <h2 class="text-lg font-medium text-gray-700 mb-3">Verifica tu correo</h2>

    <div class="mb-4 text-sm text-gray-500">
        Te enviamos un correo con un enlace de verificación. Necesitas confirmarlo antes de entrar al sistema.
    </div>

    @if (session('status') == 'verification-link-sent')
        <div class="mb-4 p-3 bg-green-50 text-green-700 rounded-lg text-sm">
            Enviamos un nuevo enlace de verificación a tu correo electrónico.
        </div>
    @endif

    <div class="mt-6 flex items-center justify-between gap-4">
        <form method="POST" action="{{ route('verification.send') }}">
            @csrf

            <button type="submit" class="px-4 py-2.5 rounded-lg text-white text-sm font-medium transition"
                style="background: linear-gradient(135deg, #7F77DD, #534AB7)">
                Reenviar correo
            </button>
        </form>

        <form method="POST" action="{{ route('logout') }}">
            @csrf

            <button type="submit" class="text-sm text-gray-500 hover:text-gray-700 transition">
                Cerrar sesión
            </button>
        </form>
    </div>
</x-guest-layout>
