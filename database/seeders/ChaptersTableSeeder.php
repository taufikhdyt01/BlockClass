<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use App\Models\ClassRoom;
use App\Models\Chapter;

class ChaptersTableSeeder extends Seeder
{
    public function run()
    {
        $classes = ClassRoom::all();

        $chapters = [
            [
                'class_id' => '1',
                'slug' => 'Modul1',
                'title' => 'Modul 1 Pengenalan Pemrograman',
                'access' => 'open',
                'order' => 1,
                'required_chapter_id' => null,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'class_id' => '1',
                'slug' => 'Modul2',
                'title' => 'Modul 2 Operator',
                'access' => 'sequential',
                'order' => 2,
                'required_chapter_id' => 1,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'class_id' => '1',
                'slug' => 'Modul3',
                'title' => 'Modul 3 Seleksi Kondisi',
                'access' => 'sequential',
                'order' => 3,
                'required_chapter_id' => 2,
                'created_at' => now(),
                'updated_at' => now()
            ],
        ];
    }
}
