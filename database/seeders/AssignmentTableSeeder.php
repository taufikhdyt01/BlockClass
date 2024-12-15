<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class AssignmentsTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('assignments')->insert([
            [
                'post_id' => 2,
                'title' => 'Assignment 1',
                'description' => 'Tugas untuk Materi Pengenalan',
                'deadline' => now()->addDays(7),
                'is_submission_closed' => false,
                'allowed_file_types' => 'pdf,docx',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'post_id' => 4,
                'title' => 'Assignment 2',
                'description' => 'Tugas untuk materi Operator',
                'deadline' => now()->addDays(14),
                'is_submission_closed' => false,
                'allowed_file_types' => 'pdf,docx',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'post_id' => 6,
                'title' => 'Assignment 3',
                'description' => 'Tugas untuk materi Seleksi Kondisi',
                'deadline' => now()->addDays(28),
                'is_submission_closed' => false,
                'allowed_file_types' => 'pdf,docx',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            // Tambahkan data lain sesuai kebutuhan
        ]);
    }
}
