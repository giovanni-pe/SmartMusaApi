<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Greenhouse; // Renamed Vivero to Greenhouse
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class GreenhouseApiController extends Controller
{
    // Get all greenhouses for the authenticated user
    public function index()
    {
        $user = Auth::user();
        $greenhouses = Greenhouse::where('user_id', $user->id)->get();

        return response()->json([
            'success' => true,
            'data' => $greenhouses
        ], 200);
    }
    public function count()
    {
        // Verificar si el usuario está autenticado
        $user = Auth::user();

        if (!$user) {
            // Si no hay usuario autenticado, devolver una respuesta vacía o un mensaje
            return response()->json([
                'success' => false,
                'message' => 'User not authenticated',
                'data' => 0 // o puedes devolver un 'null' o arreglo vacío, según prefieras
            ], 200); // También podrías usar un código 401 (Unauthorized)
        }

        // Si el usuario está autenticado, obtener el conteo de greenhouses
        $greenhousesCount = Greenhouse::where('user_id', $user->id)->count();

        return response()->json([
            'success' => true,
            'data' => $greenhousesCount
        ], 200);
    }

    // Store a new greenhouse
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'length' => 'required|numeric',
            'height' => 'required|numeric',
            'width' => 'required|numeric',
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
            'description' => 'nullable|string',
        ]);

        $greenhouse = new Greenhouse();
        $greenhouse->name = $request->name;
        $greenhouse->length = $request->length;
        $greenhouse->height = $request->height;
        $greenhouse->width = $request->width;
        $greenhouse->latitude = $request->latitude;
        $greenhouse->longitude = $request->longitude;
        $greenhouse->description = $request->description;
        $greenhouse->user_id = Auth::id(); // Assign to the authenticated user
        $greenhouse->save();

        return response()->json([
            'success' => true,
            'message' => 'Greenhouse created successfully',
            'data' => $greenhouse
        ], 201);
    }

    // Show a specific greenhouse by ID
    public function show($id)
    {
        $greenhouse = Greenhouse::where('id', $id)->where('user_id', Auth::id())->first();

        if (!$greenhouse) {
            return response()->json([
                'success' => false,
                'message' => 'Greenhouse not found'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $greenhouse
        ], 200);
    }

    // Update a specific greenhouse by ID
    public function update(Request $request, $id)
    {
        $greenhouse = Greenhouse::where('id', $id)->where('user_id', Auth::id())->first();

        if (!$greenhouse) {
            return response()->json([
                'success' => false,
                'message' => 'Greenhouse not found'
            ], 404);
        }

        $request->validate([
            'name' => 'required|string|max:255',
            'length' => 'required|numeric',
            'height' => 'required|numeric',
            'width' => 'required|numeric',
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
            'description' => 'nullable|string',
        ]);

        $greenhouse->name = $request->name;
        $greenhouse->length = $request->length;
        $greenhouse->height = $request->height;
        $greenhouse->width = $request->width;
        $greenhouse->latitude = $request->latitude;
        $greenhouse->longitude = $request->longitude;
        $greenhouse->description = $request->description;
        $greenhouse->save();

        return response()->json([
            'success' => true,
            'message' => 'Greenhouse updated successfully',
            'data' => $greenhouse
        ], 200);
    }

    // Delete a specific greenhouse by ID
    public function destroy($id)
    {
        $greenhouse = Greenhouse::where('id', $id)->where('user_id', Auth::id())->first();

        if (!$greenhouse) {
            return response()->json([
                'success' => false,
                'message' => 'Greenhouse not found'
            ], 404);
        }

        $greenhouse->delete();

        return response()->json([
            'success' => true,
            'message' => 'Greenhouse deleted successfully'
        ], 200);
    }
    // Get the latest sensor readings for a specific greenhouse
    public function getLatestSensorReadings($id)
    {
        $user = Auth::user();

        $greenhouse = Greenhouse::where('id', $id)->where('user_id', $user->id)->first();

        if (!$greenhouse) {
            return response()->json([
                'success' => false,
                'message' => 'Greenhouse not found'
            ], 404);
        }

        $latestReadings = DB::select('CALL GetLatestSensorReadings(?)', [$id]);

        return response()->json([
            'success' => true,
            'data' => $latestReadings
        ], 200);
    }
    public function getHumidityReadingsByGreenhouse(Request $request, $id)
    {
        $user = Auth::user();
        $greenhouse = Greenhouse::where('id', $id)->where('user_id', $user->id)->first();

        if (!$greenhouse) {
            return response()->json([
                'success' => false,
                'message' => 'Greenhouse not found'
            ], 404);
        }


        $startDate = $request->input('startDate', null);
        $endDate = $request->input('endDate', null);
        $humidityReadings = DB::select(
            'CALL GetHumidityReadingsByGreenhouseWithDates(?, ?, ?)',
            [$id, $startDate, $endDate]
        );
        return response()->json([
            'success' => true,
            'data' => $humidityReadings
        ], 200);
    }
    public function getSoilMoistureReadings(Request $request, $id)

    {
        $user = Auth::user();
        $greenhouse = Greenhouse::where('id', $id)->where('user_id', $user->id)->first();

        if (!$greenhouse) {
            return response()->json([
                'success' => false,
                'message' => 'Greenhouse not found'
            ], 404);
        }

        $startDate = $request->input('startDate');
        $endDate = $request->input('endDate');

        // Llamar al procedimiento almacenado pasando el ID del invernadero y el rango de fechas
        $soilMoistureReadings = DB::select('CALL GetSoilMoistureReadingsByGreenhouseWithDates(?, ?, ?)', [$id, $startDate, $endDate]);

        return response()->json([
            'success' => true,
            'data' => $soilMoistureReadings
        ], 200);
    }

    public function getIrrigationFrequencyReadings(Request $request, $id)
    {

        $user = Auth::user();
        $greenhouse = Greenhouse::where('id', $id)->where('user_id', $user->id)->first();

        if (!$greenhouse) {
            return response()->json([
                'success' => false,
                'message' => 'Greenhouse not found'
            ], 404);
        }

        $startDate = $request->input('startDate');
        $endDate = $request->input('endDate');

        // Llamar al procedimiento almacenado con los parámetros de fecha y el ID del invernadero
        $irrigationFrequencyReadings = DB::select('CALL GetDailyIrrigationCounts(?, ?, ?)', [$id, $startDate, $endDate]);

        return response()->json([
            'success' => true,
            'data' => $irrigationFrequencyReadings
        ], 200);
    }
    public function getTemperatureReadings(Request $request, $id)
    {
        $user = Auth::user();
        $greenhouse = Greenhouse::where('id', $id)->where('user_id', $user->id)->first();

        if (!$greenhouse) {
            return response()->json([
                'success' => false,
                'message' => 'Greenhouse not found'
            ], 404);
        }

        $startDate = $request->input('startDate');
        $endDate = $request->input('endDate');

        // Llamar al procedimiento almacenado con los parámetros de fecha y el ID del invernadero
        $temperatureReadings = DB::select('CALL GetAmbientTemperatureByGreenhouseWithDates(?, ?, ?)', [$id, $startDate, $endDate]);

        return response()->json([
            'success' => true,
            'data' => $temperatureReadings
        ], 200);
    }
}
