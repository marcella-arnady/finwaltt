<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Transaction;
use App\Models\Category;
use App\Models\Cashflow;

class TransactionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $date = ['2024-01-20', '2024-03-20', '2024-03-21', '2024-03-02', '2024-03-11'];
        $amount = [400000, 300000, 500000, 100000, 200000];
        $wallet = ['WA0002', 'WA0002', 'WA0003', 'WA0004', 'WA0002'];
        $categoryIds = Category::pluck('id')->toArray();
        $cashflowIds = Cashflow::pluck('id')->toArray();

        for ($i = 0; $i < 5; $i++) {
            $customID = Transaction::generateID();
            Transaction::create([
                'id' => $customID,
                'name' => "Transaction $i",
                'amount' => $amount[$i],
                'date' => $date[$i],
                'note' => "Note $i",
                'category_id' => $categoryIds[array_rand($categoryIds)],
                'cashflow_id' => $cashflowIds[array_rand($cashflowIds)],
                'user_id' => 'US0002',
                'wallet_id' => $wallet[$i],
            ]);
        }
    }
}
