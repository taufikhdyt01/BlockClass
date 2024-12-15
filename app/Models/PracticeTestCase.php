<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PracticeTestCase extends Model
{
    protected $fillable = [
        'practice_id',
        'input',
        'expected_output',
        'is_sample'
    ];

    protected $casts = [
        'is_sample' => 'boolean'
    ];

    public function practice()
    {
        return $this->belongsTo(Practice::class);
    }

    public function testResults()
    {
        return $this->hasMany(TestResult::class);
    }
}
