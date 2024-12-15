<?php

namespace Database\Seeders;

use App\Models\ClassRoom;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ClassesTableSeeder extends Seeder
{
    public function run()
    {
        $classes = [
            [
                'title' => 'Introduction to Programming',
                'detail' => 'Learn the basics of programming using Python',
                'status' => 'active',
            ],
            [
                'title' => 'Web Development Fundamentals',
                'detail' => 'HTML, CSS, and JavaScript basics',
                'status' => 'active',
            ],
            [
                'title' => 'Data Structures and Algorithms',
                'detail' => 'Advanced programming concepts',
                'status' => 'active',
            ],
            [
                'title' => 'Mobile App Development',
                'detail' => 'Building mobile applications',
                'status' => 'active',
            ],
            [
                'title' => 'Database Design',
                'detail' => 'SQL and database management',
                'status' => 'archive',
            ],
        ];

        foreach ($classes as $class) {
            ClassRoom::create([
                'title' => $class['title'],
                'detail' => $class['detail'],
                'access_code' => Str::random(6),
                'status' => $class['status'],
            ]);
        }
    }
}