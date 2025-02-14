<?php

namespace App\Repositories\Locations;

use App\Models\Locations\Location;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class LocationRepository {
    public function create (array $data) {
       return Location::create($data);
    }

    public function show ($id) {
       return Location::findOrFail($id);
    }

    public function getAll () {
       return Location::all();
    }

    public function update ($id, array $data) {
        
        $location = Location::findOrFail($id);
        
        return $location->update($data);
    }

    public function delete ($id) {
        
        $location = Location::findOrFail($id);
       return $location->delete();
    }
}