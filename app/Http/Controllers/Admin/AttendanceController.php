<?php

namespace App\Http\Controllers\Admin;

use App\Enums\AttendanceStatus;
use App\Enums\UserStatus;
use App\Http\Controllers\Controller;
use App\Http\Requests\AttendanceUpdateRequest;
use App\Models\Activity;
use App\Models\Attendance;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class AttendanceController extends Controller
{
    public function index(): View
    {
        $activities = Activity::withCount([
                'attendances',
                'attendances as present_count' => fn ($query) => $query->where('status', AttendanceStatus::PRESENT->value),
                'attendances as absent_count' => fn ($query) => $query->where('status', AttendanceStatus::ABSENT->value),
            ])
            ->orderByDesc('event_date')
            ->paginate(10);

        return view('admin.attendance.index', compact('activities'));
    }

    public function show(Activity $activity): View
    {
        $members = User::role('member')
            ->where('status', UserStatus::APPROVED->value)
            ->orderBy('name')
            ->get();

        $attendance = $activity->attendances()->get()->keyBy('user_id');

        return view('admin.attendance.show', [
            'activity' => $activity,
            'members' => $members,
            'attendance' => $attendance,
        ]);
    }

    public function update(AttendanceUpdateRequest $request, Activity $activity): RedirectResponse
    {
        foreach ($request->validated('attendance') as $entry) {
            Attendance::updateOrCreate(
                [
                    'activity_id' => $activity->id,
                    'user_id' => $entry['user_id'],
                ],
                ['status' => $entry['status']]
            );
        }

        return back()->with('status', 'Attendance updated successfully.');
    }
}
