<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use App\Models\Activity;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class ActivityController extends Controller
{
    public function index(): View
    {
        $user = Auth::user();
        $attendanceMap = $user?->attendances()
            ->get()
            ->mapWithKeys(fn ($attendance) => [$attendance->activity_id => $attendance->status->value])
            ->toArray() ?? [];

        $upcomingActivities = Activity::whereDate('event_date', '>=', now()->toDateString())
            ->orderBy('event_date')
            ->get();

        $pastActivities = Activity::whereDate('event_date', '<', now()->toDateString())
            ->orderByDesc('event_date')
            ->get();

        return view('member.activities.index', [
            'upcomingActivities' => $upcomingActivities,
            'pastActivities' => $pastActivities,
            'attendanceMap' => $attendanceMap,
        ]);
    }
}
