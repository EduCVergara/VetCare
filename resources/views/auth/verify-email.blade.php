<x-guest-layout>
    <div class="mb-8">
        <p class="text-sm font-semibold text-teal-700 dark:text-teal-300">Verificación</p>
        <h1 class="mt-2 text-3xl font-semibold text-slate-950 dark:text-white">Revisa tu correo</h1>
        <p class="mt-2 text-sm leading-6 text-slate-500 dark:text-slate-400">
            Confirma tu cuenta desde el enlace que enviamos a tu correo.
        </p>
    </div>

    @if (session('status') == 'verification-link-sent')
        <div class="vet-login-alert vet-login-alert-success">
            Enviamos un nuevo enlace de verificación.
        </div>
    @endif

    <div class="space-y-3">
        <form method="POST" action="{{ route('verification.send') }}">
            @csrf

            <button type="submit" class="vet-login-submit">
                Reenviar correo
            </button>
        </form>

        <form method="POST" action="{{ route('logout') }}">
            @csrf

            <button type="submit"
                class="flex h-12 w-full items-center justify-center rounded-2xl border border-slate-200 bg-white/70 px-5 text-sm font-semibold text-slate-600 transition duration-300 hover:-translate-y-0.5 hover:border-teal-200 hover:text-teal-700 focus:outline-none focus:ring-4 focus:ring-teal-500/20 dark:border-white/10 dark:bg-white/[0.04] dark:text-slate-300 dark:hover:border-teal-300/30 dark:hover:text-teal-200">
                Cerrar sesión
            </button>
        </form>
    </div>
</x-guest-layout>
