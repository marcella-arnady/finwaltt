<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'id' => 'US0001',
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'password' => 'admin',
            'role' => 'Admin'
        ]);

        User::create([
            'id' => 'US0002',
            'name' => 'User',
            'email' => 'user@gmail.com',
            'password' => 'user'
        ]);
    }
}
