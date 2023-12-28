<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\GeneralExpense;
use App\Models\GeneralExpenseType;
use App\Models\LabourFeeExpense;
use App\Models\PurchasingExpense;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        LabourFeeExpense::factory()->count(60)->create();
        PurchasingExpense::factory()->count(60)->create();

        $expenseType1 = GeneralExpenseType::factory()->create([
            'name' => 'Home'
        ]);

        $expenseType2 = GeneralExpenseType::factory()->create([
            'name' => 'Rice Mill Machine'
        ]);

        GeneralExpense::factory()->count(20)->create([
            'general_expense_types_id' => $expenseType1->id,
            'title' => fake()->sentence(5),
            'price' => fake()->numberBetween(10, 1000),
            'description' => fake()->paragraph(2),
            'created_at' => fake()->dateTimeBetween('-1 year', 'now'),
            'updated_at' => now(),
        ]);

        GeneralExpense::factory()->count(20)->create([
            'general_expense_types_id' => $expenseType2->id,
            'title' => fake()->sentence(5),
            'price' => fake()->numberBetween(10, 1000),
            'description' => fake()->paragraph(2),
            'created_at' => fake()->dateTimeBetween('-1 year', 'now'),
            'updated_at' => now(),
        ]);
    }
}
