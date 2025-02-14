<?php

namespace App\Services\Locations;

use App\Models\Locations\Location;
use App\Repositories\Locations\LocationRepository;

class LocationService{
    protected $locationRepository;

    public function __construct(LocationRepository $locationRepository) {
        $this->locationRepository  = $locationRepository;
    }

    public function create (array $data) {
        return $this->locationRepository->create($data);
    }

    public function getAll () {
        return $this->locationRepository->getAll();
    }

    public function show ($id) {
        
        return $this->locationRepository->show($id);
    }

    public function  update($id, array $data)  {
        
        return $this->locationRepository->update($id, $data);
    }

    public function delete ($id) {
       
        return $this->locationRepository->delete($id);
    }
    
}
