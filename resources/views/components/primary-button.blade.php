<button {{ $attributes->merge(['type' => 'submit', 'class' => 'inline-flex h-11 items-center justify-center gap-2 rounded-2xl bg-slate-950 px-4 text-sm font-semibold text-white shadow-lg shadow-slate-900/15 transition duration-300 hover:-translate-y-0.5 hover:bg-teal-700 focus:outline-none focus:ring-4 focus:ring-teal-500/20 dark:bg-teal-300 dark:text-slate-950 dark:hover:bg-emerald-200']) }}>
    {{ $slot }}
</button>
