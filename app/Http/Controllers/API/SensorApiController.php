<?php 
namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Sensor; // Renamed Sensore to Sensor
use Illuminate\Support\Facades\Auth;

class SensorApiController extends Controller
{
    // Get all sensors for the authenticated user
    public function index()
    {
        $user = Auth::user();

        $sensors = Sensor::whereHas('greenhouse', function ($query) use ($user) {
            $query->where('user_id', $user->id);
        })
        ->with('greenhouse:name,id') 
        ->get();

        return response()->json([
            'success' => true,
            'data' => $sensors
        ], 200);
    }

    // Create a new sensor
    public function store(Request $request)
    {
        $request->validate([
            'type' => 'required|string|max:255',
            'greenhouse_id' => 'required|exists:greenhouses,id',
        ]);

        $sensor = new Sensor();
        $sensor->type = $request->type;
        $sensor->greenhouse_id = $request->greenhouse_id;
        $sensor->save();

        return response()->json([
            'success' => true,
            'message' => 'Sensor created successfully',
            'data' => $sensor
        ], 201);
    }

    // Show a specific sensor
    public function show($id)
    {
        $sensor = Sensor::find($id);

        if (!$sensor) {
            return response()->json([
                'success' => false,
                'message' => 'Sensor not found'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $sensor
        ], 200);
    }

    // Update a specific sensor
    public function update(Request $request, $id)
    {
        $sensor = Sensor::find($id);

        if (!$sensor) {
            return response()->json([
                'success' => false,
                'message' => 'Sensor not found'
            ], 404);
        }

        $request->validate([
            'type' => 'required|string|max:255',
            'status' => 'required|boolean',
            'irrigation_status' => 'required|boolean',
            'greenhouse_id' => 'required|exists:greenhouses,id',
        ]);

        $sensor->type = $request->type;
        $sensor->status = $request->status;
        $sensor->irrigation_status = $request->irrigation_status;
        $sensor->greenhouse_id = $request->greenhouse_id;
        $sensor->save();

        return response()->json([
            'success' => true,
            'message' => 'Sensor updated successfully',
            'data' => $sensor
        ], 200);
    }

    // Delete a specific sensor
    public function destroy($id)
    {
        $sensor = Sensor::find($id);

        if (!$sensor) {
            return response()->json([
                'success' => false,
                'message' => 'Sensor not found'
            ], 404);
        }

        $sensor->delete();

        return response()->json([
            'success' => true,
            'message' => 'Sensor deleted successfully'
        ], 200);
    }
}
