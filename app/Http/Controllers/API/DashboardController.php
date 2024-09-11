<?php
namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Services\GreenhouseMetricsService;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    protected $metricsService;

    public function __construct(GreenhouseMetricsService $metricsService)
    {
        $this->metricsService = $metricsService;
    }

    public function avgHumidity()
    {
        $user = Auth::user();
        $avgHumidity = $this->metricsService->getAvgHumidity($user->id);
        return response()->json([
            'success' => true,
            'avg_humidity' => round($avgHumidity, 2),
        ], 200);
    }

    public function avgSoilMoisture()
    {
        $user = Auth::user();
        $avgSoilHumidity = $this->metricsService->getAvgSoilHumidity($user->id);

        return response()->json([
            'success' => true,
            'avg_soil_humidity' => round($avgSoilHumidity, 2),
        ], 200);
    }

    public function avgAmbientTemperature()
    {
        $user = Auth::user();
        $avgAmbientTemperature = $this->metricsService->getAvgAmbientTemperature($user->id);

        return response()->json([
            'success' => true,
            'avg_ambient_temperature' => round($avgAmbientTemperature, 2),
        ], 200);
    }
}
