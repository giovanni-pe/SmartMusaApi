<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class SensorReading
 *
 * @property $id
 * @property $datetime
 * @property $relative_humidity
 * @property $soil_humidity
 * @property $ambient_temperature
 * @property $sensor_id
 * @property $created_at
 * @property $updated_at
 *
 * @property Sensor $sensor
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class SensorReading extends Model
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
    protected $fillable = ['datetime', 'relative_humidity', 'soil_humidity', 'ambient_temperature', 'sensor_id'];

    /**
     * Get the sensor that owns the reading.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function sensor()
    {
        return $this->belongsTo(Sensor::class, 'sensor_id', 'id');
    }
}

