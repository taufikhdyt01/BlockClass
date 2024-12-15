<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PracticeSubmission extends Model
{
    protected $fillable = [
        'user_id',
        'practice_id',
        'score',
        'passed'
    ];

    protected $casts = [
        'passed' => 'boolean'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function practice()
    {
        return $this->belongsTo(Practice::class);
    }

    public function testResults()
    {
        return $this->hasMany(TestResult::class);
    }
}
