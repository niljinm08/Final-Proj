<?php

namespace Database\Seeders;

use App\Enums\UserStatus;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class MemberSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $member = User::firstOrCreate(
            ['email' => 'member@club.test'],
            [
                'name' => 'Sample Member',
                'password' => Hash::make('password'),
                'status' => UserStatus::APPROVED->value,
                'email_verified_at' => now(),
            ]
        );

        if (! $member->hasRole('member')) {
            $member->assignRole('member');
        }

        $extraMembers = User::factory()
            ->count(12)
            ->create();

        $extraMembers->each(function (User $user) {
            if (! $user->hasRole('member')) {
                $user->assignRole('member');
            }
        });

        $pending = User::firstOrCreate(
            ['email' => 'pending@club.test'],
            [
                'name' => 'Pending Member',
                'password' => Hash::make('password'),
                'status' => UserStatus::PENDING->value,
            ]
        );

        if (! $pending->hasRole('member')) {
            $pending->assignRole('member');
        }
    }
}
