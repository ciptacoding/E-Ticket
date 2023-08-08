<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Blacklist>
 */
class BlacklistFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => rand(3,99),
            'full_name' => fake()->name(),
            'description' => fake()->sentence(20),
            'start_date' => fake()->dateTimeThisMonth(),
            'end_date' => fake()->dateTimeThisMonth(),
        ];
    }
}
