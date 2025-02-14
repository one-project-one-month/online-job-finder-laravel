<?php

namespace App\Http\Controllers\Api\Locations;

use App\Http\Controllers\Controller;
use App\Models\Location\Location;
use App\Repositories\Locations\LocationRepositoryInterface;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class LocationController extends Controller
{
    private $locationRepository;

    public function __construct(LocationRepositoryInterface $locationRepository)
    {
        $this->locationRepository = $locationRepository;
    }

    public function index()
    {
        $locations = $this->locationRepository->getAllLocations();
        return response()->json($locations);
    }

    public function show($id)
    {
        try {
            $location = $this->locationRepository->getLocationById($id);
            return response()->json($location);
        } catch (ModelNotFoundException $e) {
            return response()->json(['message' => 'Location not found'], 404);
        }
    }

    public function store(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'name' => 'required|unique:locations|max:255',
                'description' => 'required',
            ]);

            $location = $this->locationRepository->createLocation($validatedData);
            return response()->json($location, 201);
        } catch (ValidationException $e) {
            return response()->json(['errors' => $e->errors()], 422);
        }
    }

    public function update(Request $request, $id)
    {
        
        try {
            
            $validatedData = $request->validate([
                'name' => 'required|unique:locations|max:255',
                'description' => 'required',
                'lock_version' => 'required|integer',
            ]);

            

            $location = $this->locationRepository->updateLocation($id, $validatedData);
            return response()->json($location);
        } catch (ValidationException $e) {
            return response()->json(['errors' => $e->errors()], 422);
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], 409);
        }
    }

    public function destroy($id)
    {
        try {
            $this->locationRepository->deleteLocation($id);
            return response()->json(null, 204);
        } catch (ModelNotFoundException $e) {
            return response()->json(['message' => 'Location not found'], 404);
        }
    }
}

