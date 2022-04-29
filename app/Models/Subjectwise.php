<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Subjectwise extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = [];

    protected $appends = [];

    public function getTypeTextAttribute()
    {
        $type_text = "";

        if($this->type === 1) {
            $type_text = "কুরআন";
        }

        if($this->type === 2) {
            $type_text = "হাদিস";
        }
        
        return $type_text;
    }

    public function scopeType($query, $type)
    {
        return $query->where('type', $type);
    }

    public function scopeAyah($query)
    {
        return $query->where('type', 1);
    }

    public function scopeHadith($query)
    {
        return $query->where('type', 2);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
