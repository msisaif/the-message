<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Juz extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = [];

    public $timestamps = false;

    public function ayahs()
    {
        return $this->hasMany(Ayah::class, 'juz_number', 'juz_number');
    }

    public function suras()
    {
        return $this->belongsToMany(Sura::class, 'ayahs', 'juz_number', 'sura_number')->distinct('sura_number');
    }
}
