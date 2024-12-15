<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Notifications\CustomResetPasswordNotification;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'username',
        'name',
        'email',
        'password',
        'avatar',
        'role',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function isAdmin()
    {
        return $this->role === 'admin'; 
    }

    public function sendPasswordResetNotification($token)
    {
        $this->notify(new CustomResetPasswordNotification($token));
    }

    public function classes()
    {
        return $this->belongsToMany(ClassRoom::class, 'user_classes')
                ->withTimestamps();
    }

    public function assignmentSubmissions()
    {
        return $this->hasMany(AssignmentSubmission::class);
    }

    public function forumPosts()
    {
        return $this->hasMany(ForumPost::class);
    }

    public function forumComments()
    {
        return $this->hasMany(ForumComment::class);
    }

    public function practiceSubmissions()
    {
        return $this->hasMany(PracticeSubmission::class);
    }

    public function posts()
    {
        return $this->belongsToMany(Post::class, 'user_posts')
        ->withPivot('is_done', 'score')
        ->withTimestamps();
    }

    public function classRooms()
    {
        return $this->belongsToMany(ClassRoom::class, 'user_classes');
    }
}
