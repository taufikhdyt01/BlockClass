<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use App\Models\Chapter;

class ClassContentsTableSeeder extends Seeder
{
    public function run()
    {
        $chapters = Chapter::all();

        $contents = [
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

        foreach ($chapters as $chapter) {
            foreach ($contents as $index => $contentData) {
                $contentData['class_id'] = $chapter->class_id;
                $contentData['created_at'] = now();
                $contentData['updated_at'] = now();

                // Adjusting order and required_chapter_id based on class
                $contentData['order'] = $index + 1;
                if ($index > 0) {
                    $contentData['required_chapter_id'] = DB::table('chapters')->where('class_id', $chapter->class_id)->orderBy('order', 'asc')->skip($index - 1)->first()->id;
                }

                $contentId = DB::table('chapters')->insertGetId($contentData);

                // Adding posts for each content
                $posts = [
                    [
                        'title' => 'Introduction to AI Concepts',
                        'type' => 'material',
                        'access' => 'open',
                        'required_post_id' => null,
                        'points' => 10,
                        'order' => 1,
                        'chapter_id' => $contentId,
                    ],
                    [
                        'title' => 'Deep Learning Techniques',
                        'type' => 'assignment',
                        'access' => 'hidden',
                        'required_post_id' => 1,
                        'points' => 20,
                        'order' => 2,
                        'chapter_id' => $contentId,
                    ],
                ];

                foreach ($posts as $postIndex => $postData) {
                    $postData['created_at'] = now();
                    $postData['updated_at'] = now();

                    DB::table('posts')->insert($postData);
                }
            }
        }
    }
}