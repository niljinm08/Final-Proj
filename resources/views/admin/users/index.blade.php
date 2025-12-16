@php $title = 'Users'; @endphp

<x-app-layout>
    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 mb-6">
        <div>
            <p class="text-xs uppercase tracking-wide text-slate-500">Users</p>
            <h2 class="text-lg font-semibold text-slate-900">Manage admins and members</h2>
        </div>
        <a href="{{ route('admin.users.create') }}" class="inline-flex items-center gap-2 px-4 py-2 rounded-xl bg-emerald-600 text-white font-semibold hover:bg-emerald-700">
            <span class="text-lg leading-none">＋</span>
            <span>New User</span>
        </a>
    </div>

    <div class="card p-6">
        <div class="space-y-3">
            @forelse($users as $user)
                @php $role = $user->roles->pluck('name')->first(); @endphp
                <div class="p-4 rounded-xl border border-slate-100 bg-slate-50/60 flex flex-col md:flex-row md:items-center md:justify-between gap-3">
                    <div>
                        <div class="text-base font-semibold text-slate-900">{{ $user->name }}</div>
                        <div class="text-sm text-slate-500">{{ $user->email }}</div>
                        <div class="mt-1 inline-flex px-3 py-1 rounded-full text-xs font-semibold
                            @if($user->status->value === 'approved') bg-emerald-100 text-emerald-700
                            @elseif($user->status->value === 'pending') bg-amber-100 text-amber-700
                            @else bg-rose-100 text-rose-700 @endif">
                            {{ $user->status->label() }}
                        </div>
                        <div class="text-xs text-slate-500 mt-1">Role: {{ ucfirst($role ?? 'member') }}</div>
                    </div>
                    <a href="{{ route('admin.users.edit', $user) }}" class="inline-flex items-center gap-2 px-4 py-2 rounded-xl border border-slate-200 font-semibold text-slate-800 hover:bg-slate-50">Edit</a>
                </div>
            @empty
                <p class="text-sm text-slate-500">No users found.</p>
            @endforelse
        </div>

        <div class="mt-4">
            {{ $users->links() }}
        </div>
    </div>
</x-app-layout>
