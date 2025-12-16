<?php

namespace App\Http\Controllers\Member;

use App\Models\Activity;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index(): View
    {
        $user = Auth::user();
        $upcomingActivities = Activity::whereDate('event_date', '>=', now()->toDateString())
            ->orderBy('event_date')
            ->take(5)
            ->get();

        $recentAttendance = $user?->attendances()
            ->with('activity')
            ->latest('created_at')
            ->take(5)
            ->get();

        return view('member.dashboard', [
            'user' => $user,
            'upcomingActivities' => $upcomingActivities,
            'recentAttendance' => $recentAttendance,
        ]);
    }
}
