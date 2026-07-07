<?php

namespace Database\Seeders;

use App\Models\ActivityLog;
use App\Models\User;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    public function run(): void
    {
        User::firstOrCreate(
            ['email' => 'admin@eduadmin.com'],
            [
                'name' => 'Devyani Gautam',
                'password' => 'password',
                'role' => 'admin',
                'is_active' => true,
                'department' => 'Administration',
                'subject' => 'Academic Management',
            ]
        );

        // Seed some sample recent activity
        $activities = [
            [
                'description' => '<strong>Devyani Gautam</strong> was registered as Senior Mathematics Teacher.',
                'icon' => 'user-plus',
                'color' => 'blue',
                'created_at' => now()->subHours(2),
                'updated_at' => now()->subHours(2),
            ],
            [
                'description' => 'New batch <strong>A-Level Physics (B2)</strong> created by Admin.',
                'icon' => 'batch',
                'color' => 'green',
                'created_at' => now()->subHours(5),
                'updated_at' => now()->subHours(5),
            ],
            [
                'description' => '<strong>Prof. Alan Turing</strong> updated curriculum for Data structures.',
                'icon' => 'edit',
                'color' => 'purple',
                'created_at' => now()->subDay(),
                'updated_at' => now()->subDay(),
            ],
            [
                'description' => 'Attendance alert: <strong>Grade 10-C</strong> fell below 85%.',
                'icon' => 'alert',
                'color' => 'red',
                'created_at' => now()->subDays(3),
                'updated_at' => now()->subDays(3),
            ],
        ];

        foreach ($activities as $activity) {
            ActivityLog::create($activity);
        }
    }
}
