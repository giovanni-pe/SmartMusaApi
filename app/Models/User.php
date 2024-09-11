<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Tymon\JWTAuth\Contracts\JWTSubject;

class User extends Authenticatable implements JWTSubject
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    /**
     * JWT: Get the identifier that will be stored in the JWT.
     *
     * @return mixed
     */
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * JWT: Return a key-value array of custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [
            'name' => $this->name,
            'email' => $this->email,
            'role' => 'User'
        ];
    }

    /**
     * Get the greenhouses associated with the user.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function greenhouses()
    {
        return $this->hasMany(Greenhouse::class);
    }

    /**
     * Get the crops associated with the user through greenhouses.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasManyThrough
     */
    public function crops()
    {
        return $this->hasManyThrough(Crop::class, Greenhouse::class);
    }

    /**
     * Get the sensors associated with the user through greenhouses.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasManyThrough
     */
    public function sensors()
    {
        return $this->hasManyThrough(Sensor::class, Greenhouse::class);
    }
}
