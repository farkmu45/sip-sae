<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Naration>
 */
class NarrationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

    public function definition()
    {
        return [
            'title' => fake()->words(3, true),
            'content' => fake()->words(15, true),
            'picture' => "https://picsum.photos/200/300",
            'is_published' => fake()->boolean()
        ];
    }
}
