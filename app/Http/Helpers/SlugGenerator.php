<?php

namespace App\Http\Helpers;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class SlugGenerator
{
    /**
     * Generate unique slug for given model and title
     *
     * @param string $title
     * @param string $model
     * @param string $column
     * @return string
     */
    public static function generateUniqueSlug(string $title, string $model, string $column = 'slug'): string
    {
        if (empty($title)) {
            return ''; // Return empty string jika title null/empty
        }

        $slug = Str::slug($title);
        $originalSlug = $slug;
        $count = 1;

        // Check if slug exists
        while ($model::where($column, $slug)->exists()) {
            $slug = $originalSlug . '-' . $count;
            $count++;
        }

        return $slug;
    }
}