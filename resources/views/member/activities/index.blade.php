@php $title = 'Activities'; @endphp

<x-app-layout>
    <div class="mb-6">
        <p class="text-xs uppercase tracking-wide text-slate-500">Activities</p>
        <h2 class="text-lg font-semibold text-slate-900">Club schedule</h2>
    </div>

    <div class="grid gap-6 lg:grid-cols-2">
        <div class="card p-6">
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-base font-semibold text-slate-900">Upcoming</h3>
                <span class="text-xs text-slate-500">{{ $upcomingActivities->count() }} events</span>
            </div>
            <div class="space-y-3">
                @forelse($upcomingActivities as $activity)
                    <div class="p-4 rounded-xl border border-slate-100 bg-slate-50/60">
                        <div class="flex items-start justify-between gap-3">
                            <div>
                                <div class="text-base font-semibold text-slate-900">{{ $activity->title }}</div>
                                <div class="text-xs text-slate-500">{{ $activity->event_date?->format('M j, Y') }} • {{ $activity->location }}</div>
                                @if($activity->description)
                                    <p class="text-sm text-slate-600 mt-2">{{ $activity->description }}</p>
                                @endif
                            </div>
                            <span class="px-3 py-1 rounded-full text-xs font-semibold bg-slate-100 text-slate-500">
                                Attendance not available yet
                            </span>
                        </div>
                    </div>
                @empty
                    <p class="text-sm text-slate-500">No upcoming activities yet.</p>
                @endforelse
            </div>
        </div>

        <div class="card p-6">
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-base font-semibold text-slate-900">Past</h3>
                <span class="text-xs text-slate-500">{{ $pastActivities->count() }} events</span>
            </div>
            <div class="space-y-3">
                @forelse($pastActivities as $activity)
                    <div class="p-4 rounded-xl border border-slate-100">
                        <div class="flex items-start justify-between gap-3">
                            <div>
                                <div class="text-base font-semibold text-slate-900">{{ $activity->title }}</div>
                                <div class="text-xs text-slate-500">{{ $activity->event_date?->format('M j, Y') }} • {{ $activity->location }}</div>
                                @if($activity->description)
                                    <p class="text-sm text-slate-600 mt-2">{{ $activity->description }}</p>
                                @endif
                            </div>
                            @php $status = $attendanceMap[$activity->id] ?? null; @endphp
                            @if($status)
                                <span class="px-3 py-1 rounded-full text-xs font-semibold {{ $status === 'present' ? 'bg-emerald-100 text-emerald-700' : 'bg-rose-100 text-rose-700' }}">
                                    {{ ucfirst($status) }}
                                </span>
                            @endif
                        </div>
                    </div>
                @empty
                    <p class="text-sm text-slate-500">No past activities to show.</p>
                @endforelse
            </div>
        </div>
    </div>
</x-app-layout>
