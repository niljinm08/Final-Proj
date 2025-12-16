<?php

namespace App\Http\Controllers\Admin;

use App\Enums\UserStatus;
use App\Http\Controllers\Controller;
use App\Http\Requests\MemberStatusUpdateRequest;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class MemberController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $statusFilter = UserStatus::tryFrom($request->query('status'));

        $members = User::role('member')
            ->when($statusFilter, fn ($query) => $query->where('status', $statusFilter->value))
            ->latest()
            ->paginate(12)
            ->withQueryString();

        return view('admin.members.index', [
            'members' => $members,
            'statusOptions' => UserStatus::cases(),
            'selectedStatus' => $statusFilter,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(MemberStatusUpdateRequest $request, User $member): RedirectResponse
    {
        if (! $member->hasRole('member')) {
            abort(404);
        }

        $member->update(['status' => $request->validated('status')]);
        $member->syncRoles(['member']);

        return back()->with('status', 'Member status updated successfully.');
    }
}
