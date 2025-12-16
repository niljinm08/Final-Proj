<x-guest-layout>
    <div class="space-y-6">
        <div class="space-y-1">
            <p class="text-xs uppercase tracking-[0.2em] text-slate-500">Reset access</p>
            <h1 class="text-2xl font-semibold text-slate-900">Need a new password?</h1>
            <p class="text-sm text-slate-500">Enter your email and we will send a secure reset link.</p>
        </div>

        <x-auth-session-status class="mb-2" :status="session('status')" />

        <form method="POST" action="{{ route('password.email') }}" class="space-y-4">
            @csrf

            <div class="space-y-2">
                <x-input-label for="email" :value="__('Email')" />
                <x-text-input id="email" type="email" name="email" :value="old('email')" required autofocus />
                <x-input-error :messages="$errors->get('email')" class="mt-1" />
            </div>

            <x-primary-button class="w-full justify-center">
                {{ __('Send reset link') }}
            </x-primary-button>
        </form>
    </div>
</x-guest-layout>
