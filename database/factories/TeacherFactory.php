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
            'nip' => $this->faker->randomNumber(5),
            'name' => $this->faker->name(),
            'address' => $this->faker->streetAddress(),
            'classroom_id' => $this->faker->numberBetween(1,9)
        ];
    }
}
