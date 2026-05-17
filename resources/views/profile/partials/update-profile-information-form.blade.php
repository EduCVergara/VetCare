<section>
    <header>
        <h2 class="text-lg font-semibold text-slate-950 dark:text-white">
            {{ __('messages.profile_information') }}
        </h2>

        <p class="mt-1 text-sm text-slate-500 dark:text-slate-400">
            {{ __('messages.update_your_accounts_profile_information') }}
        </p>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}" class="mt-6 space-y-6">
        @csrf
        @method('patch')

        <div>
            <x-input-label for="nombre" :value="__('messages.name')" />
            <x-text-input id="nombre" name="nombre" type="text" class="mt-2 block w-full" :value="old('nombre', $user->nombre)" required autofocus autocomplete="name" />
            <x-input-error class="mt-2" :messages="$errors->get('nombre')" />
        </div>

        <div>
            <x-input-label for="email" :value="__('messages.email')" />
            <x-text-input id="email" name="email" type="email" class="mt-2 block w-full dark:[color-scheme:dark]" :value="old('email', $user->email)" required autocomplete="username" />
            <x-input-error class="mt-2" :messages="$errors->get('email')" />

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && !$user->hasVerifiedEmail())
                <div>
                    <p class="mt-2 text-sm text-slate-600 dark:text-slate-300">
                        {{ __('messages.your_email_address_is_unverified') }}

                        <button form="send-verification"
                            class="rounded-md text-sm font-semibold text-teal-700 underline decoration-teal-300 underline-offset-4 transition hover:text-teal-900 focus:outline-none focus:ring-4 focus:ring-teal-500/15 dark:text-teal-300 dark:hover:text-teal-100">
                            {{ __('messages.click_here_to_re-send_the_verification_email') }}
                        </button>
                    </p>

                    @if (session('status') === 'verification-link-sent')
                        <p class="mt-2 text-sm font-medium text-emerald-600 dark:text-emerald-300">
                            {{ __('messages.a_new_verification_link_has_been_sent_to_your_email_address') }}
                        </p>
                    @endif
                </div>
            @endif
        </div>

        <div class="flex items-center gap-4">
            <x-primary-button>{{ __('messages.save') }}</x-primary-button>

            @if (session('status') === 'profile-updated')
                <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm font-medium text-teal-700 dark:text-teal-300">{{ __('messages.saved') }}</p>
            @endif
        </div>
    </form>
</section>
