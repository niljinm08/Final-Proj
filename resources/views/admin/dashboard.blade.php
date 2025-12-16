@php $title = 'Admin Dashboard'; @endphp

<x-app-layout>
    <div class="grid gap-4 md:grid-cols-2 lg:grid-cols-4">
        <div class="stat-card">
            <p class="text-xs uppercase tracking-wide text-slate-500">Total members</p>
            <div class="mt-2 text-3xl font-semibold text-slate-900">{{ $totalMembers }}</div>
            <p class="text-xs text-slate-500 mt-1">All registered users</p>
        </div>
        <div class="stat-card">
            <p class="text-xs uppercase tracking-wide text-slate-500">Approved</p>
            <div class="mt-2 text-3xl font-semibold text-emerald-700">{{ $approvedMembers }}</div>
            <p class="text-xs text-slate-500 mt-1">Active members</p>
        </div>
        <div class="stat-card">
            <p class="text-xs uppercase tracking-wide text-slate-500">Pending approval</p>
            <div class="mt-2 text-3xl font-semibold text-amber-600">{{ $pendingMembers }}</div>
            <p class="text-xs text-slate-500 mt-1">Awaiting officer review</p>
        </div>
        <div class="stat-card">
            <p class="text-xs uppercase tracking-wide text-slate-500">Activities</p>
            <div class="mt-2 text-3xl font-semibold text-slate-900">{{ $totalActivities }}</div>
            <p class="text-xs text-slate-500 mt-1">Scheduled and past events</p>
        </div>
    </div>

    <div class="grid gap-4 lg:grid-cols-2 mt-6">
        <div class="card p-6">
            <div class="flex items-center justify-between mb-4">
                <div>
                    <p class="text-xs uppercase tracking-wide text-slate-500">Attendance summary</p>
                    <h2 class="text-lg font-semibold text-slate-900">Per activity</h2>
                </div>
                <a href="{{ route('admin.attendance.index') }}" class="text-sm font-semibold text-emerald-700 hover:text-emerald-800">Manage</a>
            </div>
            <div class="space-y-4">
                @forelse($activities as $activity)
                    <div class="p-4 rounded-xl border border-slate-100 bg-slate-50/60 flex items-start justify-between gap-4">
                        <div>
                            <div class="font-semibold text-slate-900">{{ $activity->title }}</div>
                            <div class="text-xs text-slate-500">{{ $activity->event_date?->format('M j, Y') }} • {{ $activity->location }}</div>
                            @php
                                $total = max($activity->present_count + $activity->absent_count, 1);
                                $presentPercent = round(($activity->present_count / $total) * 100);
                            @endphp
                            <div class="mt-3 h-2 rounded-full bg-white/70 overflow-hidden">
                                <div class="h-full bg-emerald-500" style="width: {{ $presentPercent }}%"></div>
                            </div>
                        </div>
                        <div class="flex items-center gap-2">
                            <span class="px-3 py-1 rounded-full bg-emerald-100 text-emerald-700 text-xs font-semibold">Present: {{ $activity->present_count }}</span>
                            <span class="px-3 py-1 rounded-full bg-rose-100 text-rose-700 text-xs font-semibold">Absent: {{ $activity->absent_count }}</span>
                        </div>
                    </div>
                @empty
                    <p class="text-sm text-slate-500">No activities yet.</p>
                @endforelse
            </div>
        </div>

        <div class="card p-6">
            <div class="flex items-center justify-between mb-4">
                <div>
                    <p class="text-xs uppercase tracking-wide text-slate-500">Quick actions</p>
                    <h2 class="text-lg font-semibold text-slate-900">Get moving</h2>
                </div>
            </div>
            <div class="space-y-3">
                <a href="{{ route('admin.activities.create') }}" class="flex items-center justify-between px-4 py-3 rounded-xl border border-emerald-100 bg-emerald-50 text-emerald-800 font-semibold hover:bg-emerald-100">
                    <span>Create a new activity</span>
                    <span>&rarr;</span>
                </a>
                <a href="{{ route('admin.members.index') }}" class="flex items-center justify-between px-4 py-3 rounded-xl border border-slate-100 hover:bg-slate-50 font-semibold text-slate-800">
                    <span>Review member approvals</span>
                    <span>&rarr;</span>
                </a>
                <a href="{{ route('admin.attendance.index') }}" class="flex items-center justify-between px-4 py-3 rounded-xl border border-slate-100 hover:bg-slate-50 font-semibold text-slate-800">
                    <span>Update attendance</span>
                    <span>&rarr;</span>
                </a>
            </div>
        </div>
    </div>
</x-app-layout>
