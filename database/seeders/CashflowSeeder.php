<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Cashflow;

class CashflowSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $names = ['Expense', 'Income'];

        foreach ($names as $index => $name) {
            // Generate custom ID
            $cashflowId = 'CF' . sprintf('%04d', $index + 1);

            // Create cashflow with custom ID
            Cashflow::create([
                'id' => $cashflowId,
                'name' => $name,
            ]);
        }
    }
}
