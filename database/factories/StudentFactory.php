<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Student>
 */
class StudentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'student_number' => fake()->numberBetween(),
            'class' => fake()->numberBetween(1, 200),
            'crebo_number' => fake()->numberBetween(0, 99999),
            'cohort' => fake()->date(),
            'date_of_birth' => fake()->date()
        ];
    }
}
