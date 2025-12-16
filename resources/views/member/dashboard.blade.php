@php $title = 'Member Dashboard'; @endphp

<x-app-layout>
    <div class="grid gap-4 lg:grid-cols-3">
        <div class="card p-6 lg:col-span-2">
            <div class="flex items-center justify-between mb-4">
                <div>
                    <p class="text-xs uppercase tracking-wide text-slate-500">Activities</p>
                    <h2 class="text-lg font-semibold text-slate-900">Upcoming events</h2>
                </div>
                <a href="{{ route('member.activities.index') }}" class="text-sm font-semibold text-emerald-700 hover:text-emerald-800">View all</a>
            </div>
            <div class="space-y-3">
                @forelse($upcomingActivities as $activity)
                    <div class="p-4 rounded-xl border border-slate-100 bg-slate-50/60 flex items-start justify-between gap-3">
                        <div>
                            <div class="text-base font-semibold text-slate-900">{{ $activity->title }}</div>
                            <div class="text-xs text-slate-500">{{ $activity->event_date?->format('M j, Y') }} • {{ $activity->location }}</div>
                            @if($activity->description)
                                <p class="text-sm text-slate-600 mt-2">{{ $activity->description }}</p>
                            @endif
                        </div>
                    </div>
                @empty
                    <p class="text-sm text-slate-500">No upcoming activities scheduled.</p>
                @endforelse
            </div>
        </div>

        <div class="card p-6">
            <div class="mb-4">
                <p class="text-xs uppercase tracking-wide text-slate-500">Attendance</p>
                <h2 class="text-lg font-semibold text-slate-900">Recent history</h2>
            </div>
            <div class="space-y-3">
                @forelse($recentAttendance as $record)
                    <div class="p-3 rounded-xl border border-slate-100 bg-slate-50/60">
                        <div class="font-semibold text-slate-900">{{ $record->activity?->title }}</div>
                        <div class="text-xs text-slate-500">{{ $record->activity?->event_date?->format('M j, Y') }}</div>
                        <div class="mt-1 inline-flex px-3 py-1 rounded-full text-xs font-semibold
                            @if($record->status->value === 'present') bg-emerald-100 text-emerald-700
                            @else bg-rose-100 text-rose-700 @endif">
                            {{ ucfirst($record->status->value) }}
                        </div>
                    </div>
                @empty
                    <p class="text-sm text-slate-500">Attendance will appear after events are marked.</p>
                @endforelse
            </div>
        </div>
    </div>
</x-app-layout>
