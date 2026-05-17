<x-app-layout>
    <x-slot name="header">Perfil</x-slot>

    <div class="max-w-4xl space-y-6">
        <section class="vet-dashboard-surface p-5">
            <p class="text-sm font-semibold text-teal-700 dark:text-teal-300">Cuenta</p>
            <h2 class="mt-2 text-3xl font-semibold text-slate-950 dark:text-white">Perfil y seguridad</h2>
            <p class="mt-2 text-sm text-slate-500 dark:text-slate-400">
                Actualiza tus datos de acceso y preferencias esenciales.
            </p>
        </section>

        @if(session('warning') || auth()->user()->must_change_password)
            <div class="rounded-2xl border border-amber-200/80 bg-amber-50 px-5 py-4 text-sm font-medium text-amber-800 shadow-sm shadow-amber-900/5 dark:border-amber-300/20 dark:bg-amber-300/10 dark:text-amber-100">
                {{ session('warning') ?? 'Cambia tu contrasena para comenzar a usar VetCare.' }}
            </div>
        @endif

        <section class="vet-app-card p-6 sm:p-8">
            <div class="max-w-xl">
                @include('profile.partials.update-profile-information-form')
            </div>
        </section>

        <section class="vet-app-card p-6 sm:p-8">
            <div class="max-w-xl">
                @include('profile.partials.update-password-form')
            </div>
        </section>

        <section class="vet-app-card p-6 sm:p-8">
            <div class="max-w-xl">
                @include('profile.partials.two-factor-form')
            </div>
        </section>

        <section class="vet-app-card p-6 sm:p-8">
            <div class="max-w-xl">
                @include('profile.partials.delete-user-form')
            </div>
        </section>
    </div>
</x-app-layout>
