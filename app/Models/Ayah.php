<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Ayah extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = [];

    public $timestamps = false;

    public function sura()
    {
        return $this->belongsTo(Sura::class, 'sura_number', 'sura_number');
    }

    public function translations()
    {
        return $this->hasMany(Translation::class, 'ayah_number', 'ayah_number');
    }
}
