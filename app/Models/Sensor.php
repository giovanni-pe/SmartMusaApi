<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Sensor
 *
 * @property $id
 * @property $type
 * @property $status
 * @property $irrigation_status
 * @property $greenhouse_id
 * @property $created_at
 * @property $updated_at
 *
 * @property Greenhouse $greenhouse
 * @property SensorReading[] $sensorReadings
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Sensor extends Model
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
    protected $fillable = ['type', 'status', 'irrigation_status', 'greenhouse_id'];

    /**
     * Get the greenhouse that owns the sensor.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function greenhouse()
    {
        return $this->belongsTo(Greenhouse::class, 'greenhouse_id', 'id');
    }
    
    /**
     * Get the sensor readings for the sensor.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function sensorReadings()
    {
        return $this->hasMany(SensorReading::class, 'sensor_id', 'id');
    }
}
