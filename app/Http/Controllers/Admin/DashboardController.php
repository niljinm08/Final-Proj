<?php

namespace App\Http\Controllers\Admin;

use App\Enums\AttendanceStatus;
use App\Enums\UserStatus;
use App\Http\Controllers\Controller;
use App\Models\Activity;
use App\Models\User;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index(): View
    {
        $totalMembers = User::role('member')->count();
        $approvedMembers = User::role('member')->where('status', UserStatus::APPROVED->value)->count();
        $pendingMembers = User::role('member')->where('status', UserStatus::PENDING->value)->count();
        $totalActivities = Activity::count();

        $activities = Activity::withCount([
            'attendances as present_count' => fn ($query) => $query->where('status', AttendanceStatus::PRESENT->value),
            'attendances as absent_count' => fn ($query) => $query->where('status', AttendanceStatus::ABSENT->value),
        ])->orderByDesc('event_date')->take(5)->get();

        return view('admin.dashboard', [
            'totalMembers' => $totalMembers,
            'approvedMembers' => $approvedMembers,
            'pendingMembers' => $pendingMembers,
            'totalActivities' => $totalActivities,
            'activities' => $activities,
        ]);
    }
}
