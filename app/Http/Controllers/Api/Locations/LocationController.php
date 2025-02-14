<?php

namespace App\Http\Controllers\Api\Locations;

use App\Http\Controllers\Controller;
use App\Http\Resources\LocationResource;
use App\Services\Locations\LocationService;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class LocationController extends Controller
{
    private $locationService;

    public function __construct(LocationService $locationService)
    {
        $this->locationService = $locationService;
    }

    public function index()
    {
        $locations = $this->locationService->getAll();
        return response()->json($locations);
    }

    public function show($id)
    {
        try {
            $location = $this->locationService->show($id);
            return response()->json($location);
        } catch (ModelNotFoundException $e) {
            return response()->json(['message' => 'Location not found'], 404);
        }
    }

    public function store(Request $request)
    {
        $data  = $request->validate([
            'name' => 'required|unique:locations|max:255',
            'description' => 'required'
        ]);
        try {

            $location = $this->locationService->create($data);
            return response()->json(
                [
                    'status' => 'success',
                    'message' => 'Location created successfully',
                    'location' => new LocationResource($location)
                ]
            );
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()]);
        }
    }

    public function update(Request $request, $id)
    {
        $data  = $request->validate([
            'name' => 'required|unique:locations|max:255',
            'description' => 'required'
        ]);

        
        try {
            
            $this->locationService->update($id, $data);
            
            return response()->json(
                [
                    'status' => 'success',
                    'message' => 'Location updated successfully'
                ]
            );
        } catch (ValidationException $e) {
            return response()->json(['errors' => $e->errors()], 422);
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], 409);
        }
    }

    public function destroy($id)
    {
        try {
            
            $this->locationService->delete($id);
            
            return response()->json([
                'status'=>'success',
                'message'=>'Deleted successfully'
                
                
               ],200);
        } catch (ModelNotFoundException $e) {
            return response()->json(['message' => 'Location not found'], 404);
        }
    }
}

