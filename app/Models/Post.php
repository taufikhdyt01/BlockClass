<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = [
        'chapter_id',
        'title',
        'type',
        'access',
        'required_post_id',
        'order'
    ];

    public function chapter()
    {
        return $this->belongsTo(Chapter::class);
    }

    public function material()
    {
        return $this->hasOne(Material::class);
    }

    public function assignment()
    {
        return $this->hasOne(Assignment::class);
    }

    public function practice()
    {
        return $this->hasOne(Practice::class);
    }

    public function forum()
    {
        return $this->hasOne(Forum::class);
    }

    public function requiredPost()
    {
        return $this->belongsTo(Post::class, 'required_post_id');
    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'user_posts')
                ->withPivot('is_done')
                ->withTimestamps();
    }
}
