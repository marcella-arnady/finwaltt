<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Goal;

class GoalSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $endPeriod = ['2024-05-20', '2024-06-20', '2024-07-20', '2024-08-20', '2024-09-20'];
        $amount = [40000000, 30000000, 10000000, 20000000, 50000000];
        $saved = [100000, 5500000, 1000000, 100000, 700000];

        for ($i = 0; $i < 5; $i++) {
            $customID = Goal::generateID();
            Goal::create([
                'id' => $customID,
                'name' => "Goal $i",
                'amount' => $amount[$i],
                'saved' => $saved[$i],
                'startPeriod' => now()->format('Y-m-d'),
                'endPeriod' => $endPeriod[$i],
                'user_id' => 'US0002',
            ]);
        }
    }
}
