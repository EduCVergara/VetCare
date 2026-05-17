<button {{ $attributes->merge(['type' => 'submit', 'class' => 'inline-flex h-11 items-center justify-center rounded-2xl bg-rose-500 px-4 text-sm font-semibold text-white shadow-lg shadow-rose-900/15 transition duration-300 hover:-translate-y-0.5 hover:bg-rose-600 focus:outline-none focus:ring-4 focus:ring-rose-500/20 dark:bg-rose-400 dark:text-slate-950 dark:hover:bg-rose-300']) }}>
    {{ $slot }}
</button>
