<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Chapter extends Model
{
    protected $fillable = [
        'class_id',
        'title',
        'access',
        'order',
        'required_chapter_id'
    ];

    public function class()
    {
        return $this->belongsTo(ClassRoom::class);
    }

    public function posts()
    {
        return $this->hasMany(Post::class);
    }

    public function requiredChapter()
    {
        return $this->belongsTo(Chapter::class, 'required_chapter_id');
    }

}
