<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Teacher>
 */
class TeacherFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'nip' => fake()->randomNumber(5),
            'name' => fake()->name(),
            'address' => fake()->streetAddress(),
            'classroom_id' => fake()->numberBetween(1,9)
        ];
    }
}
