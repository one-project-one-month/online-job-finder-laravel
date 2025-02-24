<?php

namespace App\Services\Application;

use App\Repositories\Application\ApplicationRepository;

class ApplicationService{
    protected $applicationRepo;

    public function __construct(ApplicationRepository $applicationRepo){
        $this->applicationRepo=$applicationRepo;
    }

    public function getAllApplications(){
        return $this->applicationRepo->get();
    }

    public function createApplication($data){
        return $this->applicationRepo->create($data);
    }

    public function getApplicationById($id){
        return $this->applicationRepo->show($id);
    }

    public function update($data ,$id){
        return $this->applicationRepo->update($data,$id);
    }

    public function delete($id){
        return $this->applicationRepo->delete($id);
    }











}
