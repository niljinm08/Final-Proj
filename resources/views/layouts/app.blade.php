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
<body class="font-sans bg-slate-50 text-slate-900 antialiased">
    @php
        $user = auth()->user();
        $isAdmin = $user?->hasRole('admin');
        $iconMap = [
            'dashboard' => '<svg class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M3 12l7-9 7 9-7 9-7-9z"/><path stroke-linecap="round" stroke-linejoin="round" d="M3 12h14"/></svg>',
            'members' => '<svg class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M7 7a4 4 0 118 0 4 4 0 11-8 0z"/><path stroke-linecap="round" stroke-linejoin="round" d="M5 21a7 7 0 0114 0"/></svg>',
            'activities' => '<svg class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M4 7h16M4 12h10M4 17h7"/></svg>',
            'attendance' => '<svg class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-5"/><circle cx="12" cy="12" r="9" /></svg>',
            'users' => '<svg class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0z"/><path stroke-linecap="round" stroke-linejoin="round" d="M6 21a6 6 0 1112 0"/></svg>',
        ];

        $navItems = $isAdmin
            ? [
                ['label' => 'Dashboard', 'route' => route('admin.dashboard'), 'active' => 'admin.dashboard', 'icon' => 'dashboard'],
                ['label' => 'Members', 'route' => route('admin.members.index'), 'active' => 'admin.members.*', 'icon' => 'members'],
                ['label' => 'Activities', 'route' => route('admin.activities.index'), 'active' => 'admin.activities.*', 'icon' => 'activities'],
                ['label' => 'Attendance', 'route' => route('admin.attendance.index'), 'active' => 'admin.attendance.*', 'icon' => 'attendance'],
                ['label' => 'Users', 'route' => route('admin.users.index'), 'active' => 'admin.users.*', 'icon' => 'users'],
            ]
            : [
                ['label' => 'Dashboard', 'route' => route('member.dashboard'), 'active' => 'member.dashboard', 'icon' => 'dashboard'],
                ['label' => 'Activities', 'route' => route('member.activities.index'), 'active' => 'member.activities.*', 'icon' => 'activities'],
                ['label' => 'Attendance', 'route' => route('member.attendance.index'), 'active' => 'member.attendance.*', 'icon' => 'attendance'],
            ];
    @endphp
    <div class="min-h-screen flex">
        <aside class="hidden lg:flex w-64 flex-col bg-slate-900 text-slate-100 shadow-lg">
            <div class="px-6 py-6 border-b border-slate-800 flex items-center gap-3">
                <div class="flex items-center gap-3">
                    <div class="h-10 w-10 rounded-xl bg-emerald-500/20 border border-emerald-400/30 flex items-center justify-center text-emerald-200 font-semibold">
                        SC
                    </div>
                    <div>
                        <div class="text-sm uppercase tracking-wide text-slate-400">School Club</div>
                        <div class="text-lg font-semibold">Management</div>
                    </div>
                </div>
            </div>
            <nav class="flex-1 px-4 py-6 space-y-1">
                @foreach($navItems as $item)
                    @php
                        $isActive = request()->routeIs($item['active']);
                        $icon = $iconMap[$item['icon']] ?? null;
                    @endphp
                    <a href="{{ $item['route'] }}"
                       class="flex items-center gap-3 px-4 py-3 rounded-xl transition {{ $isActive ? 'bg-emerald-500 text-white shadow-lg shadow-emerald-500/20' : 'text-slate-200 hover:bg-slate-800' }}">
                        @if($icon)
                            <span class="flex items-center justify-center h-9 w-9 rounded-xl {{ $isActive ? 'bg-white/10' : 'bg-slate-800/80' }}">
                                {!! $icon !!}
                            </span>
                        @else
                            <span class="h-2 w-2 rounded-full {{ $isActive ? 'bg-white' : 'bg-emerald-300/60' }}"></span>
                        @endif
                        <span class="font-medium">{{ $item['label'] }}</span>
                    </a>
                @endforeach
            </nav>
            <div class="px-6 py-5 border-t border-slate-800">
                <div class="text-xs text-slate-400 mb-2">Signed in as</div>
                <div class="text-sm font-semibold">{{ $user?->name }}</div>
                <div class="text-xs text-slate-400">{{ $user?->email }}</div>
            </div>
        </aside>

        <div class="flex-1 flex flex-col min-h-screen">
            <header class="bg-white/90 backdrop-blur border-b border-slate-200">
                <div class="flex items-center justify-between px-4 sm:px-6 lg:px-8 h-16">
                    <div class="flex items-center gap-3">
                        <div>
                            <p class="text-xs uppercase tracking-wide text-slate-500">{{ $isAdmin ? 'Club Officer' : 'Member' }} area</p>
                            <h1 class="text-xl font-semibold text-slate-900">
                                {{ $title ?? ($isAdmin ? 'Admin Dashboard' : 'Member Dashboard') }}
                            </h1>
                        </div>
                    </div>
                    <div class="flex items-center gap-3">
                        <div class="hidden sm:flex flex-col text-right">
                            <span class="text-sm font-semibold text-slate-800">{{ $user?->name }}</span>
                            <span class="text-xs text-slate-500">{{ $user?->email }}</span>
                        </div>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="inline-flex items-center gap-2 px-4 py-2 rounded-xl bg-slate-900 text-white text-sm font-semibold hover:bg-slate-800 transition">
                                <span>Logout</span>
                            </button>
                        </form>
                    </div>
                </div>
            </header>

            <main class="flex-1 px-4 sm:px-6 lg:px-8 py-6">
                @if (session('status'))
                    <div class="mb-4 rounded-xl border border-emerald-100 bg-emerald-50 text-emerald-800 px-4 py-3 text-sm font-medium">
                        {{ session('status') }}
                    </div>
                @endif
                {{ $slot }}
            </main>
        </div>
    </div>
</body>
</html>
