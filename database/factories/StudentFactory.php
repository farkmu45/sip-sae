<?php

namespace Database\Factories;

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
    public function definition()
    {
        return [
            'nis' => fake()->randomNumber(5),
            'name' => fake()->name(),
            'address' => fake()->streetAddress(),
            'date_of_birth' => fake()->date(),
            'marital_status_of_parents' => fake()->words(2, true),
            'school_distance' => fake()->randomNumber(),
            'salary' => fake()->randomNumber(),
            'job_id' => fake()->numberBetween(1, 9),
            'classroom_id' => fake()->numberBetween(1, 9),
            'gender' => fake()->randomElement(['FEMALE', 'MALE']),
        ];
    }
}
