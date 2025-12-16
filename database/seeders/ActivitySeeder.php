<?php

namespace Database\Seeders;

use App\Models\Activity;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;

class ActivitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $admin = User::role('admin')->first();

        if (! $admin) {
            return;
        }

        $data = [
            [
                'title' => 'Welcome Meetup',
                'description' => 'Kick-off session to introduce the club, share expectations, and meet the team.',
                'event_date' => Carbon::now()->addDays(3)->toDateString(),
                'location' => 'Campus Hall A',
            ],
            [
                'title' => 'Community Service',
                'description' => 'Volunteer activity at the local community center.',
                'event_date' => Carbon::now()->addDays(10)->toDateString(),
                'location' => 'Downtown Center',
            ],
            [
                'title' => 'Project Showcase',
                'description' => 'Members present their semester projects and learnings.',
                'event_date' => Carbon::now()->subDays(5)->toDateString(),
                'location' => 'Innovation Lab',
            ],
        ];

        foreach ($data as $activity) {
            Activity::firstOrCreate(
                ['title' => $activity['title'], 'event_date' => $activity['event_date']],
                [...$activity, 'created_by' => $admin->id]
            );
        }
    }
}
