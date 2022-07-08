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
            'nis' => $this->faker->randomNumber(5),
            'name' => $this->faker->name(),
            'address' => $this->faker->streetAddress(),
            'date_of_birth' => $this->faker->date(),
            'marital_status_of_parents' => $this->faker->words(2, true),
            'school_distance' => $this->faker->randomNumber(),
            'salary' => $this->faker->randomNumber(),
            'job_id' => $this->faker->numberBetween(1, 9),
            'classroom_id' => $this->faker->numberBetween(1, 9),
            'gender' => $this->faker->randomElement(['FEMALE', 'MALE'])
        ];
    }
}
