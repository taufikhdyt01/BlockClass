<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PracticeTestResult extends Model
{
    protected $fillable = [
        'practice_submission_id',
        'test_case_id',
        'passed',
        'output'
    ];

    protected $casts = [
        'passed' => 'boolean'
    ];

    public function practiceSubmission()
    {
        return $this->belongsTo(PracticeSubmission::class);
    }

    public function testCase()
    {
        return $this->belongsTo(PracticeTestCase::class);
    }
}
