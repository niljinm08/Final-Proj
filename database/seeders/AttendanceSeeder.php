<?php

namespace Database\Seeders;

use App\Enums\AttendanceStatus;
use App\Models\Activity;
use App\Models\Attendance;
use App\Models\User;
use Illuminate\Database\Seeder;

class AttendanceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $member = User::role('member')->first();
        $activities = Activity::take(3)->get();

        if (! $member || $activities->isEmpty()) {
            return;
        }

        foreach ($activities as $index => $activity) {
            Attendance::updateOrCreate(
                ['user_id' => $member->id, 'activity_id' => $activity->id],
                ['status' => $index === 0 ? AttendanceStatus::PRESENT->value : AttendanceStatus::ABSENT->value]
            );
        }
    }
}
