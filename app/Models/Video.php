<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Video extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = [];

    const TYPES = [
        1 => 'সাম্প্রতিক ভিডিও',
        2 => 'শিশু বিচিত্রা',
    ];

    public static function getTypeList()
    {
        return self::TYPES;
    }

    public function getTypeTextAttribute()
    {
        return self::TYPES[$this->type] ?? '';
    }

    public function scopeType($query, $type)
    {
        return $query->where('type', $type);
    }

    public function image()
    {
        return $this->morphOne(Image::class, 'imageable');
    }

    public function playlists()
    {
        return $this->morphToMany(Playlist::class, 'playlistable')
            ->whereNull('playlistables.deleted_at');
    }
}
