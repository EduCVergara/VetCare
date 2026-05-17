<button {{ $attributes->merge(['type' => 'button', 'class' => 'inline-flex h-11 items-center justify-center rounded-2xl border border-slate-200 bg-white/70 px-4 text-sm font-semibold text-slate-600 transition duration-300 hover:-translate-y-0.5 hover:border-teal-200 hover:text-teal-700 focus:outline-none focus:ring-4 focus:ring-teal-500/15 disabled:opacity-50 dark:border-white/10 dark:bg-white/[0.04] dark:text-slate-300 dark:hover:border-teal-300/30 dark:hover:text-teal-200']) }}>
    {{ $slot }}
</button>
