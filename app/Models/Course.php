<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Course extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = [];

    public function mentors()
    {
        return $this->belongsToMany(User::class, 'course_mentor', 'mentor_id', 'course_id');
    }

    public function topics()
    {
        return $this->hasMany(Topic::class);
    }
}
