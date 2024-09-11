<?php 
namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Crop;  // Changed to Crop
use Illuminate\Support\Facades\Auth;

class CropApiController extends Controller
{
    // Get all crops for the authenticated user
    public function index()
    {
        $user = Auth::user();
    
        // Get all crops through the user's greenhouses
        $crops = $user->crops;
    
        return response()->json([
            'success' => true,
            'data' => $crops
        ], 200);
    }
    
    // Create a new crop
    public function store(Request $request)
    
    {
        var_dump($request);
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'max_supported_humidity' => 'required|numeric',
            'min_supported_humidity' => 'required|numeric',
            'max_supported_temperature' => 'required|numeric',
            'min_supported_temperature' => 'required|numeric',
            'status' => 'required|numeric',
            'greenhouse_id' => 'required|exists:greenhouses,id',
        ]);

        $crop = new Crop();
        $crop->name = $request->name;
        $crop->description = $request->description;
        $crop->max_supported_humidity = $request->max_supported_humidity;
        $crop->min_supported_humidity = $request->min_supported_humidity;
        $crop->max_supported_temperature = $request->max_supported_temperature;
        $crop->min_supported_temperature = $request->min_supported_temperature;
        $crop->status = $request->status;
        $crop->greenhouse_id = $request->greenhouse_id;
        $crop->save();

        return response()->json([
            'success' => true,
            'message' => 'Crop created successfully',
            'data' => $crop
        ], 201);
    }

    // Show a specific crop
    public function show($id)
    {
        $crop = Crop::find($id);

        if (!$crop) {
            return response()->json([
                'success' => false,
                'message' => 'Crop not found'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $crop
        ], 200);
    }

    // Update a specific crop
    public function update(Request $request, $id)
    {
        $crop = Crop::find($id);

        if (!$crop) {
            return response()->json([
                'success' => false,
                'message' => 'Crop not found'
            ], 404);
        }

        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'max_supported_humidity' => 'required|numeric',
            'min_supported_humidity' => 'required|numeric',
            'max_supported_temperature' => 'required|numeric',
            'min_supported_temperature' => 'required|numeric',
            'status' => 'required|numeric',
            'greenhouse_id' => 'required|exists:greenhouses,id',
        ]);

        $crop->name = $request->name;
        $crop->description = $request->description;
        $crop->max_supported_humidity = $request->max_supported_humidity;
        $crop->min_supported_humidity = $request->min_supported_humidity;
        $crop->max_supported_temperature = $request->max_supported_temperature;
        $crop->min_supported_temperature = $request->min_supported_temperature;
        $crop->status = $request->status;
        $crop->greenhouse_id = $request->greenhouse_id;
        $crop->save();

        return response()->json([
            'success' => true,
            'message' => 'Crop updated successfully',
            'data' => $crop
        ], 200);
    }

    // Delete a specific crop
    public function destroy($id)
    {
        $crop = Crop::find($id);

        if (!$crop) {
            return response()->json([
                'success' => false,
                'message' => 'Crop not found'
            ], 404);
        }

        $crop->delete();

        return response()->json([
            'success' => true,
            'message' => 'Crop deleted successfully'
        ], 200);
    }
}
