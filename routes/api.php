<?php
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\GreenhouseApiController;
use App\Http\Controllers\API\SensorApiController;
use App\Http\Controllers\API\SensorReadingApiController;
use App\Http\Controllers\API\CropApiController;
use App\Http\Controllers\API\DashboardController;
use App\Http\Controllers\API\ActuatorController;
// Route to get the authenticated user
Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

// Dashboard API routes
Route::middleware('auth:api')->group(function () {
    Route::get('dashboard/avg-humidity', [DashboardController::class, 'avgHumidity']);
    Route::get('dashboard/avg-temperature', [DashboardController::class, 'avgAmbientTemperature']);
    Route::get('dashboard/avg-soil-moisture', [DashboardController::class, 'avgSoilMoisture']);
});

// Authentication API routes
Route::group([
    'middleware' => 'api',
    'prefix' => 'auth'
], function () {
    Route::post('login', [App\Http\Controllers\AuthController::class, 'login']);
    Route::post('logout', [App\Http\Controllers\AuthController::class, 'logout']);
    Route::post('refresh', [App\Http\Controllers\AuthController::class, 'refresh']);
    Route::post('me', [App\Http\Controllers\AuthController::class, 'me']);
    Route::post('register', [App\Http\Controllers\AuthController::class, 'register']);
});

Route::get('/greenhouses/count', [GreenhouseApiController::class, 'count']);

// Greenhouse API routes
Route::middleware('auth:api')->group(function () {
    Route::get('greenhouses', [GreenhouseApiController::class, 'index']);      
    Route::post('greenhouses', [GreenhouseApiController::class, 'store']);       
    Route::get('greenhouses/{id}', [GreenhouseApiController::class, 'show']);   
    Route::put('greenhouses/{id}', [GreenhouseApiController::class, 'update']); 
    Route::delete('greenhouses/{id}', [GreenhouseApiController::class, 'destroy']); 
    Route::get('greenhouses/{id}/latest-readings', [GreenhouseApiController::class, 'getLatestSensorReadings']);
    Route::get('/greenhouses/{id}/humidity-readings', [GreenhouseApiController::class, 'getHumidityReadingsByGreenhouse']);
    Route::get('/greenhouses/{id}/soil-moisture-readings', [GreenhouseApiController::class, 'getSoilMoistureReadings']);
    Route::get('/greenhouses/{id}/temperature-readings', [GreenhouseApiController::class, 'getTemperatureReadings']);
    Route::get('/greenhouses/{id}/irrigation-frequency-readings', [GreenhouseApiController::class, 'getIrrigationFrequencyReadings']);

});

// Sensor API routes
Route::middleware('auth:api')->group(function () {
    Route::get('sensors', [SensorApiController::class, 'index']);         
    Route::post('sensors', [SensorApiController::class, 'store']);       
    Route::get('sensors/{id}', [SensorApiController::class, 'show']);     
    Route::put('sensors/{id}', [SensorApiController::class, 'update']);   
    Route::delete('sensors/{id}', [SensorApiController::class, 'destroy']); 
});

// Sensor Readings API routes
Route::middleware('auth:api')->group(function () {
    Route::get('sensor-readings', [SensorReadingApiController::class, 'index']);         
    Route::post('sensor-readings', [SensorReadingApiController::class, 'store']);      
    Route::get('sensor-readings/{id}', [SensorReadingApiController::class, 'show']);    
    Route::put('sensor-readings/{id}', [SensorReadingApiController::class, 'update']);   
    Route::delete('sensor-readings/{id}', [SensorReadingApiController::class, 'destroy']); 
});

// Crop API routes
Route::middleware('auth:api')->group(function () {
    Route::get('crops', [CropApiController::class, 'index']);         
    Route::post('crops', [CropApiController::class, 'store']);        
    Route::get('crops/{id}', [CropApiController::class, 'show']);    
    Route::put('crops/{id}', [CropApiController::class, 'update']);   
    Route::delete('crops/{id}', [CropApiController::class, 'destroy']); 
});
// Acatuator routes
Route::middleware('auth:api')->group(function () {       
    Route::put('/sensor/{sensor_id}/irrigation-status', [ActuatorController::class, 'updateIrrigationStatus']);
});