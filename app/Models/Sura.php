<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Sura extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = [];

    public $timestamps = false;

    public function ayahs()
    {
        return $this->hasMany(Ayah::class, 'sura_number', 'sura_number');
    }
}
