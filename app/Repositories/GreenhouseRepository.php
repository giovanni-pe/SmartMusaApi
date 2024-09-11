<?php 
namespace App\Repositories;

use Illuminate\Support\Facades\DB;

class GreenhouseRepository
{
    public function getAvgHumidity($userId)
    {
        $result = DB::select('CALL GetAvgHumidity(?)', [$userId]);
        return $result[0]->avg_humidity ?? 0;
    }

    public function getAvgSoilHumidity($userId)
    {
        $result = DB::select('CALL GetAvgSoilHumidity(?)', [$userId]);
        return $result[0]->avg_soil_humidity ?? 0;
    }

    public function getAvgAmbientTemperature($userId)
    {
        $result = DB::select('CALL GetAvgAmbientTemperature(?)', [$userId]);
        return $result[0]->avg_ambient_temperature ?? 0;
    }
}
