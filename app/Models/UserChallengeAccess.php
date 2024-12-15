<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserChallengeAccess extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'challenge_id',
        'granted_at'
    ];

    protected $casts = [
        'granted_at' => 'datetime'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function challenge()
    {
        return $this->belongsTo(Challenge::class);
    }
}
