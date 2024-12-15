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
                'title' => 'Getting Started with AI',
                'access' => 'open',
                'order' => 1,
                'required_chapter_id' => null,
            ],
            [
                'title' => 'Advanced AI Techniques',
                'access' => 'hidden',
                'order' => 2,
                'required_chapter_id' => 1,
            ],
        ];

        foreach ($classes as $class) {
            foreach ($chapters as $index => $chapterData) {
                $chapterData['class_id'] = $class->id;
                $chapterData['created_at'] = now();
                $chapterData['updated_at'] = now();

                // Adjusting order and required_chapter_id based on class
                $chapterData['order'] = $index + 1;
                if ($index > 0) {
                    $chapterData['required_chapter_id'] = DB::table('chapters')->where('class_id', $class->id)->orderBy('order', 'asc')->skip($index - 1)->first()->id;
                }

                DB::table('chapters')->insert($chapterData);
            }
        }
    }
}
