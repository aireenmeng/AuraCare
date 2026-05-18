<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Master Admin Account
        User::create([
            'name' => 'Clinic Manager',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('password'), 
            'phone' => '09123456789',
            'role' => 'admin',
        ]);

        // Dummy Patient for testing
        User::create([
            'name' => 'Aireen Rose',
            'email' => 'aireen@gmail.com',
            'password' => Hash::make('password'),
            'phone' => '09987654321',
            'role' => 'patient',
        ]);
    }
}