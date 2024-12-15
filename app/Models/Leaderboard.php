<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Leaderboard extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'challenge_id',
        'score',
        'time_spent',
        'submission_time',
    ];

    protected $casts = [
        'submission_time' => 'datetime',
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
