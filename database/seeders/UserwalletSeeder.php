<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Userwallet;

class UserwalletSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $amount = [1000000, 2000000, 5000000, 4000000, 3000000];
        $wallet = ['WA0001', 'WA0002', 'WA0003', 'WA0004', 'WA0005'];

        for ($i = 0; $i < 5; $i++) {
            Userwallet::create([
                'user_id' => 'US0002',
                'wallet_id' => $wallet[$i],
                'amount' => $amount[$i],
            ]);
        }
    }
}
