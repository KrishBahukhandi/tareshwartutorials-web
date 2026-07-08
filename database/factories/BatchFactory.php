<?php

namespace Database\Factories;

use App\Models\Batch;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Batch>
 */
class BatchFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->words(3, true),
            'grade' => fake()->randomElement(['Class 10', 'Class 11', 'Class 12']),
            'schedule_days' => ['MON', 'WED', 'FRI'],
            'start_time' => '10:00',
            'end_time' => '11:00',
            'student_limit' => 30,
            'is_active' => true,
        ];
    }

    public function inactive(): static
    {
        return $this->state(fn (array $attributes) => [
            'is_active' => false,
        ]);
    }
}
