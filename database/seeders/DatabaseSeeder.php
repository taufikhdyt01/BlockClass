<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        User::create([
            'name' => 'Admin User',
            'username' => 'admin',
            'email' => 'admin@e-block.com',
            'password' => bcrypt('password'),
            'role' => 'admin',
        ]);

        $this->call([
            ChallengeSeeder::class,
            AdditionalChallengeSeeder::class,
            WebProgrammingChallengeSeeder::class,
            WebEasyChallengeSeeder::class
        ]);
    }
}
