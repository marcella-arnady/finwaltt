<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Budget;
use App\Models\Category;

class BudgetSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $month = ['2024-03-01', '2024-03-01', '2024-03-01', '2024-03-01', '2024-03-01'];
        $amount = [4000000, 3000000, 1000000, 2000000, 5000000];
        $categoryIds = Category::pluck('id')->toArray();

        for ($i = 0; $i < 5; $i++) {
            $customID = Budget::generateID();
            Budget::create([
                'id' => $customID,
                'name' => "Budget $i",
                'amount' => $amount[$i],
                'month' => $month[$i],
                'category_id' => $categoryIds[array_rand($categoryIds)],
                'user_id' => 'US0002',
            ]);
        }
    }
}
