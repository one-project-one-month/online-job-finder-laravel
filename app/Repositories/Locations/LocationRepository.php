<?php

namespace App\Repositories\Locations;

use App\Models\Locations\Location;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class LocationRepository implements LocationRepositoryInterface
{
    public function getAllLocations()
    {
        return Location::all();
    }

    public function getLocationById($id)
    {
        return Location::findOrFail($id);
    }

    public function createLocation(array $data)
    {
        return Location::create($data);
    }

    public function updateLocation($id, array $data)
    {
        
        $location = $this->getLocationById($id);
        
        
        
        $location->update($data);
        $data['lock_version']++;
        
        return $location;
    }

    public function deleteLocation($id)
    {
        $location = $this->getLocationById($id);
        $location->delete();
        return true;
    }
}

