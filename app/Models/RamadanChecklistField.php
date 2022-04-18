<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class RamadanChecklistField extends Model
{
    use HasFactory, SoftDeletes;
    
    protected $guarded = [];

    public function getTypeAttribute($value)
    {
        switch($value) {
            case 1:
                return 'radio';

            case 2:
                return 'number';
        }
    }
}
