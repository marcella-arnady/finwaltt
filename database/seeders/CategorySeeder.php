<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $names = ['Bonus', 'Business Income', 'Debt Repayment', 'Education', 'Entertainment', 'Food', 'Gift', 'Healthcare', 'Housing', 'Investment', 'Personal Care', 'Salary', 'Savings', 'Transportation', 'Utilities', 'Other'];

        foreach ($names as $index => $categoryName) {
            // Generate custom ID
            $categoryId = 'CA' . sprintf('%04d', $index + 1);

            // Create category with custom ID
            Category::create([
                'id' => $categoryId,
                'name' => $categoryName,
            ]);
        }
    }
}
