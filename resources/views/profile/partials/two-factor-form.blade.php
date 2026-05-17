<section>
    <header>
        <h2 class="text-lg font-semibold text-slate-950 dark:text-white">
            Doble factor
        </h2>

        <p class="mt-1 text-sm text-slate-500 dark:text-slate-400">
            Protege el inicio de sesion con un codigo enviado a tu correo.
        </p>
    </header>

    @if(! config('vetcare.features.two_factor_auth'))
        <div class="mt-6 rounded-2xl border border-amber-200/80 bg-amber-50 px-5 py-4 text-sm font-medium text-amber-800 dark:border-amber-300/20 dark:bg-amber-300/10 dark:text-amber-100">
            El doble factor esta desactivado en la configuracion del sistema.
        </div>
    @else
        <form method="post" action="{{ route('profile.two-factor.update') }}" class="mt-6 space-y-5">
            @csrf
            @method('patch')

            <label class="flex cursor-pointer items-center justify-between gap-4 rounded-2xl border border-slate-200 bg-white/70 p-4 transition hover:border-teal-200 dark:border-white/10 dark:bg-white/[0.04] dark:hover:border-teal-300/30">
                <span>
                    <span class="block text-sm font-semibold text-slate-900 dark:text-white">
                        Activar verificacion en dos pasos
                    </span>
                    <span class="mt-1 block text-sm text-slate-500 dark:text-slate-400">
                        Se solicitara un codigo al iniciar sesion.
                    </span>
                </span>

                <input type="hidden" name="two_factor_enabled" value="0">
                <input type="checkbox" name="two_factor_enabled" value="1"
                    class="h-5 w-5 rounded border-slate-300 text-teal-600 focus:ring-teal-500 dark:border-white/20 dark:bg-white/[0.06] dark:focus:ring-teal-300"
                    @checked($user->two_factor_enabled)>
            </label>

            <div class="flex items-center gap-4">
                <x-primary-button>{{ __('messages.save') }}</x-primary-button>

                @if (session('status') === 'two-factor-updated')
                    <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)"
                        class="text-sm font-medium text-teal-700 dark:text-teal-300">{{ __('messages.saved') }}</p>
                @endif
            </div>
        </form>
    @endif
</section>
