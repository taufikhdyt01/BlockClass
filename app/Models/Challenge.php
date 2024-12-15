<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Challenge extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'description',
        'difficulty',
        'category',
        'access_type',
        'access_code',
        'required_challenge_id',
        'function_name',
        'initial_xml',
        'hints',
        'constraints',
    ];

    protected $casts = [
        'is_locked' => 'boolean',
        'hints' => 'json',
        'constraints' => 'json',
    ];

    protected $hidden = [
        'access_code',
    ];

    private $currentUser = null;

    public function testCases()
    {
        return $this->hasMany(TestCase::class);
    }

    public function submissions()
    {
        return $this->hasMany(Submission::class);
    }

    public function requiredChallenge()
    {
        return $this->belongsTo(Challenge::class, 'required_challenge_id');
    }

    public function userAccesses()
    {
        return $this->hasMany(UserChallengeAccess::class);
    }

    public function setCurrentUser(?User $user)
    {
        $this->currentUser = $user;
        return $this;
    }

    public function isAccessibleBy(?User $user)
   {
       // Jika user tidak login, selalu return false
       if (!$user) {
           return false;
       }

       // Jika public dan user login, bisa diakses
       if ($this->access_type === 'public') {
           return true;
       }

       // Cek akses untuk tantangan private
       if ($this->access_type === 'private') {
           return $this->userAccesses()
               ->where('user_id', $user->id)
               ->exists();
       }

       // Cek akses untuk tantangan sequential
       if ($this->access_type === 'sequential' && $this->required_challenge_id) {
           return Submission::where('user_id', $user->id)
               ->where('challenge_id', $this->required_challenge_id)
               ->where('status', 'accepted')
               ->exists();
       }

       return false;
   }

   public function getIsAccessibleAttribute()
   {
       return $this->isAccessibleBy($this->currentUser);
   }
}
