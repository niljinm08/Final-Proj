@php $title = 'Attendance'; @endphp

<x-app-layout>
    <div class="card p-6">
        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 mb-4">
            <div>
                <p class="text-xs uppercase tracking-wide text-slate-500">Attendance</p>
                <h2 class="text-lg font-semibold text-slate-900">Choose an activity</h2>
            </div>
        </div>

        <div class="space-y-3">
            @forelse($activities as $activity)
                @php $isUpcoming = $activity->event_date?->isFuture(); @endphp
                <div class="p-4 rounded-xl border border-slate-100 bg-slate-50/60 flex flex-col md:flex-row md:items-center md:justify-between gap-3">
                    <div>
                        <div class="text-base font-semibold text-slate-900">{{ $activity->title }}</div>
                        <div class="text-xs text-slate-500">{{ $activity->event_date?->format('M j, Y') }} | {{ $activity->location }}</div>
                        @if($isUpcoming)
                            <div class="mt-1 text-xs text-slate-500 flex items-center gap-2">
                                <span class="px-2 py-1 rounded-full bg-slate-100 text-slate-600 font-semibold">Attendance opens after the event date</span>
                            </div>
                        @else
                            <div class="mt-1 text-xs text-slate-500 flex items-center gap-2">
                                <span>Records: {{ $activity->attendances_count }}</span>
                                <span class="px-2 py-1 rounded-full bg-emerald-100 text-emerald-700 font-semibold">Present: {{ $activity->present_count }}</span>
                                <span class="px-2 py-1 rounded-full bg-rose-100 text-rose-700 font-semibold">Absent: {{ $activity->absent_count }}</span>
                            </div>
                        @endif
                    </div>
                    @if($isUpcoming)
                        <span class="inline-flex items-center gap-2 px-4 py-2 rounded-xl border border-slate-200 text-slate-500 font-semibold bg-slate-50 cursor-not-allowed" title="Attendance can be managed after the event date">
                            Manage
                            <span aria-hidden="true">-></span>
                        </span>
                    @else
                        <a href="{{ route('admin.attendance.show', $activity) }}" class="inline-flex items-center gap-2 px-4 py-2 rounded-xl bg-slate-900 text-white font-semibold hover:bg-slate-800">
                            Manage
                            <span aria-hidden="true">-></span>
                        </a>
                    @endif
                </div>
            @empty
                <p class="text-sm text-slate-500">No activities to manage yet.</p>
            @endforelse
        </div>

        <div class="mt-4">
            {{ $activities->links() }}
        </div>
    </div>
</x-app-layout>
