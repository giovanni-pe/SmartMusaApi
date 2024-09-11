<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Crop
 *
 * @property $id
 * @property $name
 * @property $description
 * @property $max_supported_humidity
 * @property $min_supported_humidity
 * @property $max_supported_temperature
 * @property $min_supported_temperature
 * @property $status
 * @property $greenhouse_id
 * @property $created_at
 * @property $updated_at
 *
 * @property Greenhouse $greenhouse
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Crop extends Model
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
    protected $fillable = ['name', 'description', 'max_supported_humidity', 'min_supported_humidity', 'max_supported_temperature', 'min_supported_temperature', 'status', 'greenhouse_id'];

    /**
     * Get the greenhouse that owns the crop.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function greenhouse()
    {
        return $this->belongsTo(Greenhouse::class, 'greenhouse_id', 'id');
    }
}
