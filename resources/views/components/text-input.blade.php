@props(['disabled' => false])

<input @disabled($disabled) {{ $attributes->merge(['class' => 'h-12 rounded-2xl border border-slate-200 bg-white/90 px-4 text-sm text-slate-900 shadow-sm transition duration-300 placeholder:text-slate-400 hover:border-teal-200 focus:border-teal-500 focus:outline-none focus:ring-4 focus:ring-teal-500/15 dark:border-white/10 dark:bg-white/[0.055] dark:text-white dark:placeholder:text-slate-500 dark:hover:border-teal-300/30 dark:focus:border-teal-300 dark:focus:ring-teal-300/15']) }}>
