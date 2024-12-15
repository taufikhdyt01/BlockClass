<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use App\Models\Chapter;

class PostsTableSeeder extends Seeder
{
    public function run()
    {
        $chapters = Chapter::all();

        $posts = [
            [
                'id' => '1',
                'chapter_id' => '1',
                'title' => 'Materi 1 Pengenalan Pemrograman',
                'type' => 'material',
                'access' => 'open',
                'required_post_id' => null,
                'points' => 10,
                'order' => 1,
            ],
            [
                'id' => '2',
                'chapter_id' => '1',
                'title' => 'Tugas 1 Pengenalan Pemrograman',
                'type' => 'assignment',
                'access' => 'sequential',
                'required_post_id' => 1,
                'points' => 10,
                'order' => 2,
            ],
            [
                'id' => '3',
                'chapter_id' => '2',
                'title' => 'Materi 2 Operator',
                'type' => 'material',
                'access' => 'sequential',
                'required_post_id' => 2,
                'points' => 10,
                'order' => 1,
            ],
            [
                'id' => '4',
                'chapter_id' => '2',
                'title' => 'Tugas 2 Operator',
                'type' => 'assignment',
                'access' => 'sequential',
                'required_post_id' => 3,
                'points' => 10,
                'order' => 2,
            ],
            [
                'id' => '5',
                'chapter_id' => '3',
                'title' => 'Materi 3 Seleksi Kondisi',
                'type' => 'material',
                'access' => 'sequential',
                'required_post_id' => 4,
                'points' => 10,
                'order' => 1,
            ],
            [
                'id' => '6',
                'chapter_id' => '3',
                'title' => 'Tugas 3 Seleksi Kondisi',
                'type' => 'assignment',
                'access' => 'sequential',
                'required_post_id' => 5,
                'points' => 10,
                'order' => 2,
            ],

        ];
    }
}