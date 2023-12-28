<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\LabourFeeExpense>
 */
class LabourFeeExpenseFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'worker_number' => fake()->randomNumber(5),
            'quantity' => fake()->numberBetween(1, 100),
            'price' => fake()->numberBetween(100, 1000),
            'description' => fake()->sentence(),
            'created_at' => fake()->dateTimeBetween('-2 year', 'now'),
            'updated_at' => now(),
        ];
    }
}
