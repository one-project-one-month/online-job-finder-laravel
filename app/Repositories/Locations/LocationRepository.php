<?php

namespace App\Repositories\Locations;

use App\Models\Locations\Location;

class LocationRepository {
    public function create (array $data) {
       $location= Location::create($data);
       return $location;
    }

    public function show ($id) {
       $location= Location::findOrFail($id);
       return $location;
    }

    public function getAll () {
       $location= Location::latest()->get();
        return $location;
    }

    public function update (array $data ,$id) {
        $location = Location::findOrFail($id);
         $location->update($data);
         return $location;
    }

    public function delete ($id) {

        $location = Location::findOrFail($id);
        $location->delete();
        return $location;
    }
}
