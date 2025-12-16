<?php

use App\Http\Controllers\Admin\ActivityController;
use App\Http\Controllers\Admin\AttendanceController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\MemberController;
use App\Http\Controllers\Admin\UserManagementController;
use App\Http\Controllers\Member\ActivityController as MemberActivityController;
use App\Http\Controllers\Member\AttendanceController as MemberAttendanceController;
use App\Http\Controllers\Member\DashboardController as MemberDashboardController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('login');
});

Route::middleware(['auth', 'approved'])->group(function () {
    Route::get('/dashboard', function () {
        return auth()->user()?->hasRole('admin')
            ? redirect()->route('admin.dashboard')
            : redirect()->route('member.dashboard');
    })->name('dashboard');

    Route::prefix('admin')->as('admin.')->middleware('role:admin')->group(function () {
        Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');
        Route::resource('members', MemberController::class)->only(['index', 'update']);
        Route::resource('activities', ActivityController::class)->except(['show']);
        Route::resource('users', UserManagementController::class)->except(['show', 'destroy']);

        Route::get('attendance', [AttendanceController::class, 'index'])->name('attendance.index');
        Route::get('attendance/{activity}', [AttendanceController::class, 'show'])->name('attendance.show');
        Route::put('attendance/{activity}', [AttendanceController::class, 'update'])->name('attendance.update');
    });

    Route::prefix('member')->as('member.')->middleware('role:member')->group(function () {
        Route::get('/dashboard', [MemberDashboardController::class, 'index'])->name('dashboard');
        Route::get('/activities', [MemberActivityController::class, 'index'])->name('activities.index');
        Route::get('/attendance', [MemberAttendanceController::class, 'index'])->name('attendance.index');
    });
});

require __DIR__.'/auth.php';
