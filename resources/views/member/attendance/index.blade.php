@php $title = 'Attendance'; @endphp

<x-app-layout>
    <div class="mb-6">
        <p class="text-xs uppercase tracking-wide text-slate-500">Attendance</p>
        <h2 class="text-lg font-semibold text-slate-900">Your attendance history</h2>
    </div>

    <div class="card p-6">
        <div class="space-y-4">
            @forelse($records as $record)
                @php
                    $activity = $record->activity;
                    $isFuture = $activity?->event_date?->isFuture();
                @endphp
                <div class="p-4 rounded-xl border border-slate-100 bg-slate-50/60 flex flex-col md:flex-row md:items-center md:justify-between gap-3">
                    <div>
                        <div class="font-semibold text-slate-900">{{ $activity?->title }}</div>
                        <div class="text-xs text-slate-500">
                            {{ $activity?->event_date?->format('M j, Y') }} | {{ $activity?->location }}
                        </div>
                    </div>
                    @if($isFuture)
                        <span class="px-3 py-1 rounded-full text-xs font-semibold bg-slate-100 text-slate-500">
                            Attendance not available yet
                        </span>
                    @else
                        <span class="px-3 py-1 rounded-full text-xs font-semibold
                            @if($record->status->value === 'present') bg-emerald-100 text-emerald-700
                            @else bg-rose-100 text-rose-700 @endif">
                            {{ ucfirst($record->status->value) }}
                        </span>
                    @endif
                </div>
            @empty
                <p class="text-sm text-slate-500">No attendance records yet.</p>
            @endforelse
        </div>

        <div class="mt-4">
            {{ $records->links() }}
        </div>
    </div>
</x-app-layout>
