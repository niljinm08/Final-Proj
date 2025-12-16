@php $title = 'Edit Activity'; @endphp

<x-app-layout>
    <div class="card p-6 max-w-3xl">
        <div class="mb-4 flex items-center justify-between">
            <div>
                <p class="text-xs uppercase tracking-wide text-slate-500">Activities</p>
                <h2 class="text-lg font-semibold text-slate-900">Edit activity</h2>
            </div>
            <a href="{{ route('admin.attendance.show', $activity) }}" class="text-sm font-semibold text-emerald-700 hover:text-emerald-800">Manage attendance</a>
        </div>

        <form method="POST" action="{{ route('admin.activities.update', $activity) }}" class="space-y-4">
            @csrf
            @method('PUT')

            <div class="space-y-2">
                <x-input-label for="title" :value="__('Title')" />
                <x-text-input id="title" name="title" type="text" :value="old('title', $activity->title)" required />
                <x-input-error :messages="$errors->get('title')" class="mt-1" />
            </div>

            <div class="space-y-2">
                <x-input-label for="description" :value="__('Description')" />
                <textarea id="description" name="description" rows="3" class="w-full rounded-xl border border-slate-200 bg-slate-50 text-slate-900 focus:border-emerald-500 focus:ring-emerald-500">{{ old('description', $activity->description) }}</textarea>
                <x-input-error :messages="$errors->get('description')" class="mt-1" />
            </div>

            <div class="grid gap-4 md:grid-cols-2">
                <div class="space-y-2">
                    <x-input-label for="event_date" :value="__('Event date')" />
                    <x-text-input id="event_date" name="event_date" type="date" :value="old('event_date', optional($activity->event_date)->format('Y-m-d'))" required />
                    <x-input-error :messages="$errors->get('event_date')" class="mt-1" />
                </div>
                <div class="space-y-2">
                    <x-input-label for="location" :value="__('Location')" />
                    <x-text-input id="location" name="location" type="text" :value="old('location', $activity->location)" required />
                    <x-input-error :messages="$errors->get('location')" class="mt-1" />
                </div>
            </div>

            <div class="flex items-center gap-2 justify-end">
                <x-secondary-button type="button" onclick="history.back()">Cancel</x-secondary-button>
                <x-primary-button>Save changes</x-primary-button>
            </div>
        </form>
    </div>
</x-app-layout>
