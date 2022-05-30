<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Mentor extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = [];  
  
    public function image()
    {
        return $this->morphOne(Image::class, 'imageable');
    }

    public function courses()
    {
        return $this->belongsToMany(Course::class)
            ->whereNull('course_mentor.deleted_at');
    }
}
