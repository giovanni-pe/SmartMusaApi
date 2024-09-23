<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\SensorReading; // Renamed LecturasSensore to SensorReading
use Illuminate\Support\Facades\Auth;
use App\Models\Sensor;

class SensorReadingApiController extends Controller
{
    // Get all sensor readings for the authenticated user
    public function index()
    {
        $user = Auth::user();

        // Get all sensor readings related to the user's greenhouses
        $readings = SensorReading::whereHas('sensor', function ($query) use ($user) {
            $query->whereHas('greenhouse', function ($query) use ($user) {
                $query->where('user_id', $user->id);
            });
        })->get();

        return response()->json([
            'success' => true,
            'data' => $readings
        ], 200);
    }


    public function store(Request $request)
    {
        $request->validate([
            'relative_humidity' => 'required|numeric',
            'soil_humidity' => 'required|numeric',
            'ambient_temperature' => 'required|numeric',
            'sensor_id' => 'required|exists:sensors,id',
        ]);
        $sensor = Sensor::find($request->sensor_id);
        if (!$sensor) {
            return response()->json([
                'success' => false,
                'message' => 'Sensor not found'
            ], 404);
        }
        $reading = new SensorReading();
        $reading->relative_humidity = $request->relative_humidity;
        $reading->soil_humidity = $request->soil_humidity;
        $reading->ambient_temperature = $request->ambient_temperature;
        $reading->sensor_id = $sensor->id;
        $reading->save();
        $irrigation_status = $sensor->irrigation_status;
        return response()->json([
            'irrigation_status' => $irrigation_status,
            'success' => true,
        ], 201);
    }


    // Show a specific sensor reading
    public function show($id)
    {
        $reading = SensorReading::find($id);

        if (!$reading) {
            return response()->json([
                'success' => false,
                'message' => 'Reading not found'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $reading
        ], 200);
    }

    // Update a specific sensor reading
    public function update(Request $request, $id)
    {
        $reading = SensorReading::find($id);

        if (!$reading) {
            return response()->json([
                'success' => false,
                'message' => 'Reading not found'
            ], 404);
        }

        $request->validate([
            'relative_humidity' => 'required|numeric',
            'soil_humidity' => 'required|numeric',
            'ambient_temperature' => 'required|numeric',
            'sensor_id' => 'required|exists:sensors,id',
        ]);

        $reading->relative_humidity = $request->relative_humidity;
        $reading->soil_humidity = $request->soil_humidity;
        $reading->ambient_temperature = $request->ambient_temperature;
        $reading->sensor_id = $request->sensor_id;
        $reading->save();

        return response()->json([
            'success' => true,
            'message' => 'Reading updated successfully',
            'data' => $reading
        ], 200);
    }

    // Delete a specific sensor reading
    public function destroy($id)
    {
        $reading = SensorReading::find($id);

        if (!$reading) {
            return response()->json([
                'success' => false,
                'message' => 'Reading not found'
            ], 404);
        }

        $reading->delete();

        return response()->json([
            'success' => true,
            'message' => 'Reading deleted successfully'
        ], 200);
    }
}
