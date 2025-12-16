<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AttendanceController extends Controller
{
    public function index(): View
    {
        $user = Auth::user();

        $records = $user?->attendances()
            ->with('activity')
            ->orderByDesc('created_at')
            ->paginate(10);

        return view('member.attendance.index', [
            'records' => $records,
        ]);
    }
}
