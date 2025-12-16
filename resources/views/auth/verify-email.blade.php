<x-guest-layout>
    <div class="space-y-6">
        <div class="space-y-1">
            <p class="text-xs uppercase tracking-[0.2em] text-slate-500">Verify email</p>
            <h1 class="text-2xl font-semibold text-slate-900">Check your inbox</h1>
            <p class="text-sm text-slate-500">We sent a verification link to finish setting up your account.</p>
        </div>

        @if (session('status') == 'verification-link-sent')
            <div class="rounded-xl border border-emerald-100 bg-emerald-50 text-emerald-800 px-4 py-3 text-sm font-medium">
                {{ __('A new verification link has been sent to your email address.') }}
            </div>
        @endif

        <div class="flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
            <form method="POST" action="{{ route('verification.send') }}">
                @csrf
                <x-primary-button>
                    {{ __('Resend verification email') }}
                </x-primary-button>
            </form>

            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="text-sm font-semibold text-slate-600 hover:text-slate-800">
                    {{ __('Log out') }}
                </button>
            </form>
        </div>
    </div>
</x-guest-layout>
