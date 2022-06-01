<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Tymon\JWTAuth\Contracts\JWTSubject;

class User extends Authenticatable implements JWTSubject
{
    use HasFactory, Notifiable;

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }
    /**
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return ['user' => ['id' => $this->id]];
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'email', 'password', 'firstName', 'lastName', 'age', 'education',
        'isTeacher',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function offers() : HasMany
    {
        return $this->hasMany(Offer::class);
    }

    public function appointments() : HasMany
    {
        return $this->hasMany(Appointment::class);
    }

    /*public function appointments() :
    \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(Appointment::class)->withTimestamps();
    }*/


}
