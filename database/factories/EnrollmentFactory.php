<?php

namespace Database\Factories;

use App\Models\Batch;
use App\Models\Enrollment;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Enrollment>
 */
class EnrollmentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'student_id' => User::factory()->state(['role' => 'student', 'is_active' => true]),
            'batch_id' => Batch::factory(),
            'enrollment_date' => now(),
            'status' => 'active',
            'progress_percentage' => 0,
            'last_accessed_at' => null,
            'notes' => null,
        ];
    }

    public function dropped(): static
    {
        return $this->state(fn (array $attributes) => [
            'status' => 'dropped',
        ]);
    }
}
