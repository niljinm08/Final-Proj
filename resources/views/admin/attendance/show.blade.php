@php $title = 'Attendance'; @endphp

<x-app-layout>
    <div class="card p-6">
        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-3 mb-4">
            <div>
                <p class="text-xs uppercase tracking-wide text-slate-500">Attendance</p>
                <h2 class="text-lg font-semibold text-slate-900">{{ $activity->title }}</h2>
                <p class="text-sm text-slate-500">{{ $activity->event_date?->format('M j, Y') }} • {{ $activity->location }}</p>
            </div>
            <a href="{{ route('admin.attendance.index') }}" class="text-sm font-semibold text-emerald-700 hover:text-emerald-800">Back to list</a>
        </div>

        <form method="POST" action="{{ route('admin.attendance.update', $activity) }}" class="space-y-4">
            @csrf
            @method('PUT')

            <div class="space-y-3">
                @forelse($members as $index => $member)
                    @php
                        $record = $attendance[$member->id] ?? null;
                        $status = $record?->status->value ?? 'absent';
                    @endphp
                    <div class="p-4 rounded-xl border border-slate-100 bg-slate-50/60 flex flex-col md:flex-row md:items-center md:justify-between gap-3">
                        <div>
                            <div class="font-semibold text-slate-900">{{ $member->name }}</div>
                            <div class="text-sm text-slate-500">{{ $member->email }}</div>
                        </div>
                        <div class="flex items-center gap-3">
                            <input type="hidden" name="attendance[{{ $index }}][user_id]" value="{{ $member->id }}">
                            <select name="attendance[{{ $index }}][status]" class="rounded-xl border border-slate-200 bg-white text-sm text-slate-700 focus:border-emerald-500 focus:ring-emerald-500">
                                <option value="present" @selected($status === 'present')>Present</option>
                                <option value="absent" @selected($status === 'absent')>Absent</option>
                            </select>
                        </div>
                    </div>
                @empty
                    <p class="text-sm text-slate-500">No approved members to track for this activity.</p>
                @endforelse
            </div>

            @if($members->count())
                <div class="flex justify-end">
                    <x-primary-button>Save attendance</x-primary-button>
                </div>
            @endif
        </form>
    </div>
</x-app-layout>
