<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Wallet;

class WalletSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $names = ['Cash', 'BCA', 'BRI', 'BNI', 'Bank Mandiri', 'Bank Danamon', 'Bank CIMB Niaga', 'Bank Panin', 'Bank Permata', 'Bank Mega', 'Bank Bukopin', 'Bank Jago', 'Allo Bank', 'Blu', 'OCTO Mobile', 'GoPay', 'OVO', 'Dana', 'LinkAja', 'ShopeePay', 'Jenius', 'Sakuku', 'Kredivo', 'Paytren', 'TCASH', 'Other'];

        foreach ($names as $index => $name) {
            // Generate custom ID
            $walletId = 'WA' . sprintf('%04d', $index + 1);

            // Create wallet with custom ID
            Wallet::create([
                'id' => $walletId,
                'name' => $name,
            ]);
        }
    }
}
