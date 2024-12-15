<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Submission extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'challenge_id',
        'xml',
        'status',
        'score',
        'time_spent',
        'submitted_at',
    ];

    protected $casts = [
        'submitted_at' => 'datetime',
        'time_spent' => 'integer'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function challenge()
    {
        return $this->belongsTo(Challenge::class);
    }

    public function testResults()
    {
        return $this->hasMany(TestResult::class);
    }

    public function getFormattedTimeSpentAttribute()
    {
        if (!$this->time_spent) {
            return '-';
        }

        $seconds = floor($this->time_spent / 1000);
        $minutes = floor($seconds / 60);
        $hours = floor($minutes / 60);
        
        $seconds = $seconds % 60;
        $minutes = $minutes % 60;

        return sprintf(
            '%02d:%02d:%02d',
            $hours,
            $minutes,
            $seconds
        );
    }
}
