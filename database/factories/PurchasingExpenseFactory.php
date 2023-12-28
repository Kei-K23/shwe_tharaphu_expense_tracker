<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\PurchasingExpense>
 */
class PurchasingExpenseFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {

        return [
            'item_name' => fake()->word(),
            'quantity' => fake()->numberBetween(1, 100),
            'unit_price' => fake()->numberBetween(100, 1000),
            'total_cost' => fake()->numberBetween(100, 1000),
            'description' => fake()->sentence(5),
            'created_at' => fake()->dateTimeBetween('-2 year', 'now'),
            'updated_at' => now(),
        ];
    }
}
