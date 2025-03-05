<?php

namespace App\Services\SavedJob;

use App\Repositories\SavedJob\SavedJobRepository;

class SavedJobService{

        protected $savedJobRepo;
        public function __construct(SavedJobRepository $savedJobRepo){
         $this->savedJobRepo=$savedJobRepo;
        }

        public function savedJobsList(){
            return $this->savedJobRepo->savedJobs();
        }
}
