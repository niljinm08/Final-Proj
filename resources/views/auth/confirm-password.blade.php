<x-guest-layout>
    <div class="space-y-6">
        <div class="space-y-1">
            <p class="text-xs uppercase tracking-[0.2em] text-slate-500">Security check</p>
            <h1 class="text-2xl font-semibold text-slate-900">Confirm your password</h1>
            <p class="text-sm text-slate-500">Please confirm to continue in this secure area.</p>
        </div>

        <form method="POST" action="{{ route('password.confirm') }}" class="space-y-4">
            @csrf

            <div class="space-y-2">
                <x-input-label for="password" :value="__('Password')" />
                <x-text-input id="password" type="password" name="password" required autocomplete="current-password" />
                <x-input-error :messages="$errors->get('password')" class="mt-1" />
            </div>

            <x-primary-button class="w-full justify-center">
                {{ __('Confirm') }}
            </x-primary-button>
        </form>
    </div>
</x-guest-layout>
