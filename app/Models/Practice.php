<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Practice extends Model
{
    protected $fillable = [
        'description',
        'initial_xml',
        'initial_blocks'
    ];

    public function post()
    {
        return $this->belongsTo(Post::class);
    }

    public function testCases()
    {
        return $this->hasMany(PracticeTestCase::class);
    }

    public function submissions()
    {
        return $this->hasMany(PracticeSubmission::class);
    }

}
