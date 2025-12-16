@php $title = 'Activities'; @endphp

<x-app-layout>
    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 mb-6">
        <div>
            <p class="text-xs uppercase tracking-wide text-slate-500">Events</p>
            <h2 class="text-lg font-semibold text-slate-900">Manage activities</h2>
        </div>
        <a href="{{ route('admin.activities.create') }}" class="inline-flex items-center gap-2 px-4 py-2 rounded-xl bg-emerald-600 text-white font-semibold hover:bg-emerald-700">
            <span class="text-lg leading-none">＋</span>
            <span>New Activity</span>
        </a>
    </div>

    <div class="grid gap-6 lg:grid-cols-2">
        <div class="card p-6">
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-base font-semibold text-slate-900">Upcoming</h3>
                <span class="text-xs text-slate-500">{{ $upcomingActivities->count() }} scheduled</span>
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
                            <div class="flex gap-2">
                                <a href="{{ route('admin.attendance.show', $activity) }}" class="text-xs px-3 py-2 rounded-lg bg-slate-900 text-white font-semibold hover:bg-slate-800">Attendance</a>
                                <a href="{{ route('admin.activities.edit', $activity) }}" class="text-xs px-3 py-2 rounded-lg border border-slate-200 font-semibold text-slate-800 hover:bg-slate-50">Edit</a>
                                <form method="POST" action="{{ route('admin.activities.destroy', $activity) }}" onsubmit="return confirm('Delete this activity?');">
                                    @csrf
                                    @method('DELETE')
                                    <x-danger-button class="text-xs px-3 py-2">Delete</x-danger-button>
                                </form>
                            </div>
                        </div>
                    </div>
                @empty
                    <p class="text-sm text-slate-500">No upcoming activities.</p>
                @endforelse
            </div>
        </div>

        <div class="card p-6">
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-base font-semibold text-slate-900">Past</h3>
                <span class="text-xs text-slate-500">{{ $pastActivities->count() }} completed</span>
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
                            <div class="flex gap-2">
                                <a href="{{ route('admin.attendance.show', $activity) }}" class="text-xs px-3 py-2 rounded-lg bg-slate-900 text-white font-semibold hover:bg-slate-800">Attendance</a>
                                <a href="{{ route('admin.activities.edit', $activity) }}" class="text-xs px-3 py-2 rounded-lg border border-slate-200 font-semibold text-slate-800 hover:bg-slate-50">Edit</a>
                                <form method="POST" action="{{ route('admin.activities.destroy', $activity) }}" onsubmit="return confirm('Delete this activity?');">
                                    @csrf
                                    @method('DELETE')
                                    <x-danger-button class="text-xs px-3 py-2">Delete</x-danger-button>
                                </form>
                            </div>
                        </div>
                    </div>
                @empty
                    <p class="text-sm text-slate-500">No past activities yet.</p>
                @endforelse
            </div>
        </div>
    </div>
</x-app-layout>
