<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Classification extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = [];

    protected $appends = [
        'ayahs'
    ];

    public function getAyahsAttribute()
    {
        $array = explode('-', $this->ayah);
        
        $data[] = $first = (int) $array[0];

        $last = (int) $array[count($array) - 1] ?? $first;

        while($first < $last) {
            $first++;
            $data[] = (int) $first;
        }

        return array_filter($data);
    }

    public function sura()
    {
        return $this->belongsTo(Sura::class, 'sura_number');
    }
}
