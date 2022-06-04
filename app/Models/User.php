<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, SoftDeletes, HasRoles;

    protected $guarded = [];

    public static $type = [
        1 => 'Admin',
        2 => 'User',
    ];

    public function getTypeNameAttribute()
    {
        return (self::$type)[$this->type] ?? '';
    }

    public function scopeOnlyAdmin($query)
    {
        return $query->where('type', 1);
    }

    public function scopeOnlyUser($query)
    {
        return $query->where('type', 2);
    }

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    protected $appends = [
        'email_verified',
    ];

    public function getEmailVerifiedAttribute()
    {
        return $this->email_verified_at
            ? $this->email_verified_at->diffForHumans()
            : '';
    }

    public function ramadan_checklists()
    {
        return $this->hasMany(RamadanChecklist::class);
    }

    public function checklists()
    {
        return $this->hasMany(Checklist::class);
    }

    public function courses()
    {
        return $this->belongsToMany(Course::class, 'course_mentor', 'course_id', 'mentor_id');
    }

    public function participants()
    {
        return $this->hasMany(Participant::class);
    }
    
    public function image()
    {
        return $this->morphOne(Image::class, 'imageable');
    }
}