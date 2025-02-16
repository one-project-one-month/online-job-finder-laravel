<?php

namespace App\Http\Controllers\Api\Locations;

use App\Http\Controllers\Controller;
use App\Http\Requests\locationRequest;
use App\Http\Resources\LocationResource;
use App\Models\Locations\Location;
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
        try {
            $locations = $this->locationService->getAll();
            return response()->json([
                'message'=>'fetching successful',
                'status'=>'success',
               'data'=>[
                'locations'=> LocationResource::collection($locations)
               ]
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'message'=>$e->getMessage(),
                'status'=>'error'
            ],500);
        }
    }

    public function show($id)
    {
        try {
            $location = $this->locationService->show($id);
            return response()->json([
                'message'=>'fetching location success',
                'status'=>'success',
                'data'=>[
                    'location'=>new LocationResource($location)
                ]
                ]);
        } catch (\Exception $e) {
            return response()->json([
                'message' => $e->getMessage(),
                'status'=>'error'
            ],500);
        }
    }

    public function store(locationRequest $request)
    {
        try {

            $location = $this->locationService->create($request->toArray());
            return response()->json(
                [
                    'status' => 'success',
                    'message' => 'Location created successfully',
                    'data'=>[
                        'location' => new LocationResource($location)
                    ]
                ]
            );
        } catch (\Exception $e) {
            return response()->json([
                'message' => $e->getMessage(),
                'status'=>'error'
            ],500);
        }
    }

    public function update(locationRequest $request, Location $location)
    {


        try {
           $location= $this->locationService->update($request->toArray(),$location->id);

            return response()->json(
                [
                    'status' => 'success',
                    'message' => 'Location updated successfully',
                   'data'=>[
                    'location'=>new LocationResource($location)
                   ]
                ]
            );
        }  catch (\Exception $e) {
            return response()->json(
                ['message' => $e->getMessage(),
                'status'=>'error'
                ] , 500);
        }
    }

    public function destroy(Location $location)
    {
        try {

            $this->locationService->delete( $location->id );

            return response()->json([
                'status'=>'success',
                'message'=>'Deleted successfully'
               ],200);
        } catch (\Exception $e) {
            return response()->json(
                [
                    'message' => $e->getMessage(),
                    'status'=>'error'
                ] , 500);
        }
    }
}

