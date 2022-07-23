<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Playlist extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = [];

    protected $appends = [
        'type_text'
    ];

    public function getTypeTextAttribute()
    {
        return Video::TYPES[$this->type] ?? '';
    }

    public function scopeType($query, $type)
    {
        return $query->where('type', $type);
    }

    public function image()
    {
        return $this->morphOne(Image::class, 'imageable');
    }

    public function videos()
    {
        return $this->morphedByMany(Video::class, 'playlistable')
            ->whereNull('playlistables.deleted_at');
    }
}
