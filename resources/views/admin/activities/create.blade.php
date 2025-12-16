@php $title = 'Create Activity'; @endphp

<x-app-layout>
    <div class="card p-6 max-w-3xl">
        <div class="mb-4">
            <p class="text-xs uppercase tracking-wide text-slate-500">Activities</p>
            <h2 class="text-lg font-semibold text-slate-900">New activity</h2>
        </div>

        <form method="POST" action="{{ route('admin.activities.store') }}" class="space-y-4">
            @csrf

            <div class="space-y-2">
                <x-input-label for="title" :value="__('Title')" />
                <x-text-input id="title" name="title" type="text" :value="old('title')" required />
                <x-input-error :messages="$errors->get('title')" class="mt-1" />
            </div>

            <div class="space-y-2">
                <x-input-label for="description" :value="__('Description')" />
                <textarea id="description" name="description" rows="3" class="w-full rounded-xl border border-slate-200 bg-slate-50 text-slate-900 focus:border-emerald-500 focus:ring-emerald-500">{{ old('description') }}</textarea>
                <x-input-error :messages="$errors->get('description')" class="mt-1" />
            </div>

            <div class="grid gap-4 md:grid-cols-2">
                <div class="space-y-2">
                    <x-input-label for="event_date" :value="__('Event date')" />
                    <x-text-input id="event_date" name="event_date" type="date" :value="old('event_date')" required />
                    <x-input-error :messages="$errors->get('event_date')" class="mt-1" />
                </div>
                <div class="space-y-2">
                    <x-input-label for="location" :value="__('Location')" />
                    <x-text-input id="location" name="location" type="text" :value="old('location')" required />
                    <x-input-error :messages="$errors->get('location')" class="mt-1" />
                </div>
            </div>

            <div class="flex items-center gap-2 justify-end">
                <x-secondary-button type="button" onclick="history.back()">Cancel</x-secondary-button>
                <x-primary-button>Create activity</x-primary-button>
            </div>
        </form>
    </div>
</x-app-layout>
