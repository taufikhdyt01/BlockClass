<?php

namespace Database\Seeders;

use App\Models\Chapter;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            ChallengeSeeder::class,
            AdditionalChallengeSeeder::class,
            WebProgrammingChallengeSeeder::class,
            WebEasyChallengeSeeder::class,
            UsersTableSeeder::class,
            ClassesTableSeeder::class,
            ChaptersTableSeeder::class,
            PostsTableSeeder::class,
            ClassContentsTableSeeder::class
        ]);
    }
}
