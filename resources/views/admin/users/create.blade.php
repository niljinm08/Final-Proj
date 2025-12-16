@php $title = 'New User'; @endphp

<x-app-layout>
    <div class="card p-6 max-w-3xl">
        <div class="mb-4">
            <p class="text-xs uppercase tracking-wide text-slate-500">Users</p>
            <h2 class="text-lg font-semibold text-slate-900">Create user</h2>
        </div>

        <form method="POST" action="{{ route('admin.users.store') }}" class="space-y-4">
            @csrf

            <div class="space-y-2">
                <x-input-label for="name" :value="__('Name')" />
                <x-text-input id="name" name="name" type="text" :value="old('name')" required />
                <x-input-error :messages="$errors->get('name')" class="mt-1" />
            </div>

            <div class="space-y-2">
                <x-input-label for="email" :value="__('Email')" />
                <x-text-input id="email" name="email" type="email" :value="old('email')" required />
                <x-input-error :messages="$errors->get('email')" class="mt-1" />
            </div>

            <div class="space-y-2">
                <x-input-label for="password" :value="__('Password')" />
                <x-text-input id="password" name="password" type="password" required />
                <x-input-error :messages="$errors->get('password')" class="mt-1" />
            </div>

            <div class="grid gap-4 md:grid-cols-2">
                <div class="space-y-2">
                    <x-input-label for="role" :value="__('Role')" />
                    <select id="role" name="role" class="w-full rounded-xl border border-slate-200 bg-white text-sm text-slate-700 focus:border-emerald-500 focus:ring-emerald-500">
                        <option value="member" @selected(old('role') === 'member')>Member</option>
                        <option value="admin" @selected(old('role') === 'admin')>Admin</option>
                    </select>
                    <x-input-error :messages="$errors->get('role')" class="mt-1" />
                </div>
                <div class="space-y-2">
                    <x-input-label for="status" :value="__('Status')" />
                    <select id="status" name="status" class="w-full rounded-xl border border-slate-200 bg-white text-sm text-slate-700 focus:border-emerald-500 focus:ring-emerald-500">
                        @foreach($statusOptions as $status)
                            <option value="{{ $status->value }}" @selected(old('status') === $status->value)>{{ $status->label() }}</option>
                        @endforeach
                    </select>
                    <x-input-error :messages="$errors->get('status')" class="mt-1" />
                </div>
            </div>

            <div class="flex items-center gap-2 justify-end">
                <x-secondary-button type="button" onclick="history.back()">Cancel</x-secondary-button>
                <x-primary-button>Create user</x-primary-button>
            </div>
        </form>
    </div>
</x-app-layout>
