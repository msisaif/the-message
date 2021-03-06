<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Translation extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = [];

    public $timestamps = false;

    public function resourcer()
    {
        return $this->belongsTo(Resource::class, 'resource_id');
    }
}
