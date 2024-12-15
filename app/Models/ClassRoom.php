<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClassRoom extends Model
{
    use HasFactory;
    protected $table = 'classes';

    protected $fillable = [
        'title',
        'detail', 
        'access_code',
        'status'
    ];

    public function users()
    {
        return $this->belongsToMany(User::class, 'user_classes', 'class_id', 'user_id');
    }

    public function chapters()
    {
        return $this->hasMany(Chapter::class, 'class_id');
    }
}
