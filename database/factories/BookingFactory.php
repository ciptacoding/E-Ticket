<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

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
            'order_update' => Str::random(30),
            'user_id' => rand(2,99),
            'order_date' => fake()->dateTimeThisMonth(),
            'check_in' => fake()->dateTimeThisMonth(),
            'check_out' => fake()->dateTimeThisMonth(),
            'full_name' => fake()->name(),
            'address' => fake()->address(),
            'phone' => fake()->phoneNumber(),
            'gender' => fake()->randomElement(['Male','Female']),
            'total_price' => 25000,
            'status' => fake()->randomElement(['Unpaid', 'Paid'])
        ];
    }

    public function TodayFactory(): Factory
    {
        return $this->state(function (array $attributes) {
            return [
                'order_update' => Str::random(30),
                'user_id' => rand(2,99),
                'order_date' => date('Y-m-d'),
                'check_in' => date('Y-m-d'),
                'check_out' => date('Y-m-d'),
                'full_name' => fake()->name(),
                'address' => fake()->address(),
                'phone' => fake()->phoneNumber(),
                'gender' => fake()->randomElement(['Male','Female']),
                'total_price' => 25000,
                'status' => 'Paid'
            ];
        });
    }
}
