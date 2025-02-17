<?php

namespace App\Services\Resumes;
use App\Services\Resumes\ResumeService;
use App\Repositories\Resumes\ResumeRepository;


  class ResumeService{

     protected $resumeRepository;

     public function __construct(ResumeRepository $resumeRepository){
        $this->resumeRepository = $resumeRepository;
     }

     public function createResume( array $data){

        dd($data);

        return $this->resumeRepository->create($data);
     }

     public function getAllResumes(){

        return $this->resumeRepository->all();
     }

     public function getResume($id)
     {
         return $this->resumeRepository->find($id); // Calls the repository to get JobCategory by id
     }

     public function updateResumes(array $data, $id)
     {
         return $this->resumeRepository->update($data, $id);

     }

     public function deleteResumes($id){
         return $this->resumeRepository->delete($id);
     }




  }



?>
