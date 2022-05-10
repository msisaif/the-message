<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Video extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = [];

    public function scopeType($query, $type)
    {
        return $query->where('type', $type);
    }

    public function image()
    {
        return $this->morphOne(Image::class, 'imageable');
    }
}
