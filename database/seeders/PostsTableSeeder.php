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
                'title' => 'Introduction to AI Concepts',
                'type' => 'material',
                'access' => 'open',
                'required_post_id' => null,
                'points' => 10,
                'order' => 1,
            ],
            [
                'title' => 'Deep Learning Techniques',
                'type' => 'assignment',
                'access' => 'hidden',
                'required_post_id' => 1,
                'points' => 20,
                'order' => 2,
            ],
        ];

        foreach ($chapters as $chapter) {
            foreach ($posts as $index => $postData) {
                $postData['chapter_id'] = $chapter->id;
                $postData['created_at'] = now();
                $postData['updated_at'] = now();

                // Adjusting order and required_post_id based on chapter
                $postData['order'] = $index + 1;
                if ($index > 0) {
                    $postData['required_post_id'] = DB::table('posts')->where('chapter_id', $chapter->id)->orderBy('order', 'asc')->skip($index - 1)->first()->id;
                }

                DB::table('posts')->insert($postData);
            }
        }
    }
}