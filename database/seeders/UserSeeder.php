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
            'levelId' => 0,
            'firstName' => 'John',
            'lastName' => 'Doe',
            'email' => 'admin@admin.com',
            'password' => Hash::make('password'), // Use Hash to encrypt passwords
        ]);
    }
}
