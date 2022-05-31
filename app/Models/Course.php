<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Course extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = [];

    public function topics()
    {
        return $this->hasMany(Topic::class);
    }

    public function image()
    {
        return $this->morphOne(Image::class, 'imageable');
    }

    public function mentors()
    {
        return $this->belongsToMany(Mentor::class)
            ->whereNull('course_mentor.deleted_at')
            ->orderBy('course_mentor.id');
    }
}
