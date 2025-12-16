@props(['disabled' => false])

<input
    @disabled($disabled)
    {{ $attributes->merge(['class' => 'w-full rounded-xl border border-slate-200 bg-slate-50 text-slate-900 focus:border-emerald-500 focus:ring-emerald-500 placeholder:text-slate-400']) }}
>
