<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Admin',
            'username' => 'admin',
            'email' => 'admin@gmail.com',
            'role' => 'admin',
            'email_verified_at' => now(),
            'password' => Hash::make('password')
        ]);

        User::create([
            'name' => 'User',
            'username' => 'user',
            'email' => 'user@gmail.com',
            'role' => 'user',
            'email_verified_at' => now(),
            'password' => Hash::make('password')
        ]);
    }
}
