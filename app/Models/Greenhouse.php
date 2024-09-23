<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Greenhouse
 *
 * @property $id
 * @property $name
 * @property $length
 * @property $height
 * @property $width
 * @property $latitude
 * @property $longitude
 * @property $description
 * @property $user_id
 * @property $created_at
 * @property $updated_at
 *
 * @property User $user
 * @property Crop[] $crops
 * @property Sensor[] $sensors
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Greenhouse extends Model
{
    /**
     * Number of records per page for pagination.
     *
     * @var int
     */
    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
        protected $fillable = ['name', 'length', 'height', 'width', 'latitude', 'longitude', 'description', 'user_id'];
    
    
    /**
     * Get the user that owns the greenhouse.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    /**
     * Get the crops associated with the greenhouse.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function crops()
    {
        return $this->hasMany(Crop::class, 'greenhouse_id', 'id');
    }

    /**
     * Get the sensors associated with the greenhouse.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function sensors()
    {
        return $this->hasMany(Sensor::class, 'greenhouse_id', 'id');
    }
}

