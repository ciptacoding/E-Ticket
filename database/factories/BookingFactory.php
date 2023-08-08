<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Booking>
 */
class BookingFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => rand(2,20),
            'username' => fake()->name(),
            'email' => fake()->email(),
            'check_in' => fake()->dateTimeThisMonth(),
            'check_out' => fake()->dateTimeThisMonth(),
            'full_name' => fake()->name(),
            'address' => fake()->address(),
            'phone' => fake()->phoneNumber(),
            'gender' => fake()->randomElement(['Male','Female']),
            'total_price' => 25000,
            'status' => 'Paid',
            'status_entrance' => 'Check In',
        ];
    }
}
