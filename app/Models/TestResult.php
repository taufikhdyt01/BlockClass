<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TestResult extends Model
{
    use HasFactory;

    protected $fillable = [
        'submission_id',
        'test_case_id',
        'passed',
        'output',
        'console_output',
    ];

    protected $casts = [
        'passed' => 'boolean',
        'output' => 'json',
    ];

    public function submission()
    {
        return $this->belongsTo(Submission::class);
    }

    public function testCase()
    {
        return $this->belongsTo(TestCase::class);
    }
}
