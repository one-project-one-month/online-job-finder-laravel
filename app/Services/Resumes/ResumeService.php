<?php

namespace App\Services\Resumes;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use App\Repositories\Resumes\ResumeRepository;



  class ResumeService{

     protected $resumeRepository;

     public function __construct(ResumeRepository $resumeRepository){
        $this->resumeRepository = $resumeRepository;
     }

     public function createResume($user_id, UploadedFile $data)
     {
        return $this->resumeRepository->create($user_id,$data);
     }


     public function getAllResumes(){

        return $this->resumeRepository->all();
     }

     public function getResumeById($id)
     {
         return $this->resumeRepository->find($id);
     }

     public function updateResume($userId,$file, $resumeId)
     {
        $existResume=$this->getResumeById($resumeId);
        if ($existResume) {
            $filePath = str_replace('/storage/', '', $existResume->file_path);
            if (Storage::exists($filePath)) {
                Storage::delete($filePath);
            }

        }

        return $this->resumeRepository->update($userId,$file,$resumeId);



     }

     public function deleteResume($resume){
        $filePath = str_replace('/storage/', '', $resume->file_path);
        if (Storage::exists($filePath)) {
            Storage::delete($filePath);
        }
         return $this->resumeRepository->delete($resume->id);
     }
    }











