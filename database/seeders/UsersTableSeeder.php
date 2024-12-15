<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    public function run()
    {
        // Create admin
        User::create([
            'username' => 'Admin',
            'name' => 'Admin User',
            'email' => 'admin@example.com',
            'password' => Hash::make('password123'),
            'role' => 'admin'
        ]);

        // Create teachers
        User::factory()->count(5)->create([
            'role' => 'teacher'
        ]);

        // Create students
        User::factory()->count(50)->create([
            'role' => 'student'
        ]);
    }
}