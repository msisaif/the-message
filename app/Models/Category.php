<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = [];

    public function contents()
    {
        return $this->hasMany(Subjectwise::class);
    }

    public function ayah_list()
    {
        return $this->hasMany(Subjectwise::class)->where('type', 1);
    }

    public function hadis_list()
    {
        return $this->hasMany(Subjectwise::class)->where('type', 2);
    }
}
