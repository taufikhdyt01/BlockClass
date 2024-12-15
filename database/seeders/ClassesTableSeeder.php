<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use App\Http\Helpers\SlugGenerator;
use App\Models\ClassRoom;

class ClassesTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('classes')->insert([
            [
                'slug' => 'introduction-to-ai',
                'banner' => 'banner1.jpg',
                'title' => 'Introduction to AI',
                'detail' => 'A comprehensive course on Artificial Intelligence.',
                'access_code' => strtoupper(Str::random(10)),
                'status' => 'active',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'slug' => 'advanced-php',
                'banner' => 'banner2.jpg',
                'title' => 'Advanced PHP',
                'detail' => 'Deep dive into PHP for advanced developers.',
                'access_code' => strtoupper(Str::random(10)),
                'status' => 'active',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'slug' => 'web-development-basics',
                'banner' => 'banner3.jpg',
                'title' => 'Web Development Basics',
                'detail' => 'Learn the basics of web development.',
                'access_code' => strtoupper(Str::random(10)),
                'status' => 'active',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
