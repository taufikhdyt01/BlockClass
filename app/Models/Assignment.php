<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Assignment extends Model
{
    protected $fillable = [
        'post_id',
        'title',
        'description',
        'deadline',
        'is_submission_closed',
        'allowed_file_types'
    ];

    protected $casts = [
        'deadline' => 'datetime',
        'is_submission_closed' => 'boolean'
    ];

    public function post()
    {
        return $this->belongsTo(Post::class);
    }

    public function files()
    {
        return $this->hasMany(AssignmentFile::class);
    }

    public function submissions()
    {
        return $this->hasMany(AssignmentSubmission::class);
    }

}
