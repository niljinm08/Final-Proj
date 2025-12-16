<x-guest-layout>
    <div class="space-y-6">
        <div class="space-y-1">
            <p class="text-xs uppercase tracking-[0.2em] text-slate-500">Join the club</p>
            <h1 class="text-2xl font-semibold text-slate-900">Create your member account</h1>
            <p class="text-sm text-slate-500">New members are set to <span class="font-semibold text-emerald-700">pending</span> until a club officer approves access.</p>
        </div>

        <form method="POST" action="{{ route('register') }}" class="space-y-4">
            @csrf

            <div class="space-y-2">
                <x-input-label for="name" :value="__('Name')" />
                <x-text-input id="name" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
                <x-input-error :messages="$errors->get('name')" class="mt-1" />
            </div>

            <div class="space-y-2">
                <x-input-label for="email" :value="__('Email')" />
                <x-text-input id="email" type="email" name="email" :value="old('email')" required autocomplete="username" />
                <x-input-error :messages="$errors->get('email')" class="mt-1" />
            </div>

            <div class="space-y-2">
                <x-input-label for="password" :value="__('Password')" />
                <x-text-input id="password" type="password" name="password" required autocomplete="new-password" />
                <x-input-error :messages="$errors->get('password')" class="mt-1" />
            </div>

            <div class="space-y-2">
                <x-input-label for="password_confirmation" :value="__('Confirm Password')" />
                <x-text-input id="password_confirmation" type="password" name="password_confirmation" required autocomplete="new-password" />
                <x-input-error :messages="$errors->get('password_confirmation')" class="mt-1" />
            </div>

            <div class="flex items-center justify-between">
                <p class="text-sm text-slate-500">Default role: <span class="font-semibold text-slate-700">member</span>.</p>
                <a class="text-emerald-700 font-semibold hover:text-emerald-800" href="{{ route('login') }}">
                    {{ __('Already registered?') }}
                </a>
            </div>

            <x-primary-button class="w-full justify-center">
                {{ __('Register') }}
            </x-primary-button>
        </form>
    </div>
</x-guest-layout>
