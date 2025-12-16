@php $title = 'Members'; @endphp

<x-app-layout>
    <div class="card p-6">
        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
            <div>
                <p class="text-xs uppercase tracking-wide text-slate-500">Member registry</p>
                <h2 class="text-lg font-semibold text-slate-900">Approve or reject accounts</h2>
            </div>
            <form method="GET" class="flex items-center gap-2">
                <select name="status" class="rounded-xl border border-slate-200 bg-white text-sm text-slate-700 focus:border-emerald-500 focus:ring-emerald-500">
                    <option value="">All statuses</option>
                    @foreach($statusOptions as $status)
                        <option value="{{ $status->value }}" @selected($selectedStatus?->value === $status->value)>{{ $status->label() }}</option>
                    @endforeach
                </select>
                <x-secondary-button type="submit">Filter</x-secondary-button>
            </form>
        </div>

        <div class="mt-6 space-y-3">
            @forelse($members as $member)
                <div class="p-4 rounded-xl border border-slate-100 bg-slate-50/50 flex flex-col md:flex-row md:items-center md:justify-between gap-3">
                    <div>
                        <div class="text-base font-semibold text-slate-900">{{ $member->name }}</div>
                        <div class="text-sm text-slate-500">{{ $member->email }}</div>
                        <div class="mt-1 inline-flex px-3 py-1 rounded-full text-xs font-semibold
                            @if($member->status->value === 'approved') bg-emerald-100 text-emerald-700
                            @elseif($member->status->value === 'pending') bg-amber-100 text-amber-700
                            @else bg-rose-100 text-rose-700 @endif">
                            {{ $member->status->label() }}
                        </div>
                    </div>
                    <form method="POST" action="{{ route('admin.members.update', $member) }}" class="flex items-center gap-2">
                        @csrf
                        @method('PUT')
                        <select name="status" class="rounded-xl border border-slate-200 bg-white text-sm text-slate-700 focus:border-emerald-500 focus:ring-emerald-500">
                            @foreach($statusOptions as $status)
                                <option value="{{ $status->value }}" @selected($member->status === $status)>{{ $status->label() }}</option>
                            @endforeach
                        </select>
                        <x-primary-button>Update</x-primary-button>
                    </form>
                </div>
            @empty
                <p class="text-sm text-slate-500">No members found.</p>
            @endforelse
        </div>

        <div class="mt-4">
            {{ $members->links() }}
        </div>
    </div>
</x-app-layout>
