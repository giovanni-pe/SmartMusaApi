<?php
namespace App\Http\Controllers\API;
use App\Http\Controllers\Controller;
use App\Models\Sensor;
use Illuminate\Http\Request;

class ActuatorController extends Controller
{

    public function updateIrrigationStatus(Request $request, $sensor_id)
    {
       
        $request->validate([
            'irrigation_status' => 'required|integer',
        ]);
        $sensor = Sensor::find($sensor_id);
        
        if (!$sensor) {
            return response()->json([
                'success' => false,
                'message' => 'Sensor not found'
            ], 404);
        }

        $sensor->irrigation_status = $request->irrigation_status;
        $sensor->save();
        return response()->json([
            'success' => true,
            'message' => 'Irrigation status updated successfully',
            'sensor' => $sensor
        ], 200);
    }
}
