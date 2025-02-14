<?php

namespace App\Repositories\Locations;

interface LocationRepositoryInterface
{
    public function getAllLocations();
    public function getLocationById($id);
    public function createLocation(array $data);
    public function updateLocation($id, array $data);
    public function deleteLocation($id);
}

