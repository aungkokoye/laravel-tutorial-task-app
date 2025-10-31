<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Task>
 */
class TaskFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            "name" => fake()->sentence(),
            "description" => fake()->paragraph(),
            "long_description" => fake()->paragraph(7, true),
            "completed" => fake()->boolean(),
        ];
    }

    public function unverified(): static
    {
        return $this->state(fn (array $attributes) => [
            "name" => fake()->sentence(3, false),
        ]);
    }
}
