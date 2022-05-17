<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Checklist extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = [];

    public function getChecklistAttribute($value)
    {
        return json_decode($value, 1);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
