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
                'slug' => 'Python',
                'banner' => 'PyhtonBanner.jpg',
                'title' => 'Pemrograman Dasar Pyhton',
                'detail' => 'Python adalah salah satu bahasa pemrograman yang mudah dipelajari, serbaguna, dan populer. Bahasa ini digunakan di berbagai bidang seperti pengembangan web, analisis data, kecerdasan buatan, dan banyak lagi.',
                'access_code' => 'PY001',
                'status' => 'active',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'slug' => 'PHP',
                'banner' => 'PHPBanner.jpg',
                'title' => 'Pemrograman Dasar PHP',
                'detail' => 'Pembelajaran Dasar PHP',
                'access_code' => 'PHP001',
                'status' => 'archive',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'slug' => 'Javascript',
                'banner' => 'JavascriptBanner.jpg',
                'title' => 'Pemgrograman dasar Javascript',
                'detail' => 'Pengenalan bahasa pemrograman Javascript',
                'access_code' => 'JS001',
                'status' => 'active',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
