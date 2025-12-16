<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'School Club') }}</title>

        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@400;500;600;700&display=swap" rel="stylesheet">

        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="bg-slate-50 text-slate-900 antialiased">
        <div class="min-h-screen grid grid-cols-1 lg:grid-cols-2">
            <div class="hidden lg:flex flex-col justify-between bg-gradient-to-br from-slate-900 via-emerald-900 to-slate-800 text-white p-10">
                <div class="flex items-center gap-3">
                    <div class="h-10 w-10 rounded-xl bg-white/10 border border-white/20 flex items-center justify-center font-semibold">
                        SC
                    </div>
                    <div>
                        <div class="text-sm uppercase tracking-[0.2em] text-emerald-200/80">School Club</div>
                        <div class="text-2xl font-semibold">Management System</div>
                    </div>
                </div>
                <div class="space-y-4">
                    <h1 class="text-3xl font-semibold leading-tight">Organize members, activities, and attendance with confidence.</h1>
                    <p class="text-sm text-emerald-100/80 max-w-md">Role-based dashboards keep officers productive while members see exactly what they need.</p>
                    <div class="flex items-center gap-2 text-xs text-emerald-100/80 uppercase tracking-wide">
                        <span class="h-2 w-2 rounded-full bg-emerald-300"></span>
                        Live status updates for approvals
                    </div>
                </div>
                <div class="text-xs text-emerald-100/70">Built for campus clubs • Laravel + Blade • Secure by default</div>
            </div>

            <div class="flex items-center justify-center py-10 px-6">
                <div class="w-full max-w-md space-y-6">
                    <div class="flex items-center gap-3">
                        <a href="/" class="inline-flex h-12 w-12 rounded-xl bg-slate-900 text-white items-center justify-center font-semibold">SC</a>
                        <div>
                            <p class="text-xs uppercase tracking-wide text-slate-500">Welcome</p>
                            <h2 class="text-xl font-semibold text-slate-900">School Club Management</h2>
                        </div>
                    </div>
                    <div class="bg-white shadow-xl shadow-slate-200/60 border border-slate-100 rounded-2xl p-8">
                        {{ $slot }}
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
