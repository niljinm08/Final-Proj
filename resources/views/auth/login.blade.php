<x-guest-layout>
    <div class="space-y-6">
        <div class="space-y-1">
            <p class="text-xs uppercase tracking-[0.2em] text-slate-500">Sign in</p>
            <h1 class="text-2xl font-semibold text-slate-900">Welcome back</h1>
            <p class="text-sm text-slate-500">Access your role-based dashboard. Pending members will be prompted to await approval.</p>
        </div>

        <x-auth-session-status class="mb-2" :status="session('status')" />

        <form method="POST" action="{{ route('login') }}" class="space-y-4">
            @csrf

            <div class="space-y-2">
                <x-input-label for="email" :value="__('Email')" />
                <x-text-input id="email" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
                <x-input-error :messages="$errors->get('email')" class="mt-1" />
            </div>

            <div class="space-y-2">
                <x-input-label for="password" :value="__('Password')" />
                <x-text-input id="password" type="password" name="password" required autocomplete="current-password" />
                <x-input-error :messages="$errors->get('password')" class="mt-1" />
            </div>

            <div class="flex items-center justify-between text-sm">
                <label for="remember_me" class="inline-flex items-center gap-2 text-slate-600">
                    <input id="remember_me" type="checkbox" class="rounded border-slate-300 text-emerald-600 focus:ring-emerald-500" name="remember">
                    <span>{{ __('Remember me') }}</span>
                </label>

                @if (Route::has('password.request'))
                    <a class="text-emerald-700 font-semibold hover:text-emerald-800" href="{{ route('password.request') }}">
                        {{ __('Forgot password?') }}
                    </a>
                @endif
            </div>

            <x-primary-button class="w-full justify-center">
                {{ __('Log in') }}
            </x-primary-button>

            <p class="text-sm text-slate-500 text-center">
                {{ __("Don't have an account?") }}
                <a href="{{ route('register') }}" class="font-semibold text-emerald-700 hover:text-emerald-800">Create one</a>
            </p>
        </form>
    </div>
</x-guest-layout>
