<?php

namespace App\Repositories\ApplicantEducation;

use App\Models\ApplicantEducation\ApplicantEducation;

class ApplicantEducationRepository
{
    public function create(array $data){
      return ApplicantEducation::create($data);
    }

    public function update(array $data,$id){
        $applicantEducation = ApplicantEducation::findOrFail($id);
        $applicantEducation->update($data);
        return $applicantEducation;
    }

    public function delete($id){
        $applicantEducation = ApplicantEducation::findOrFail($id);
        $applicantEducation->delete();
        return $applicantEducation;
    }

    public function show($id){
        return ApplicantEducation::findOrFail($id);
    }

    public function getAll(){
        $applicantEducations = ApplicantEducation::latest()->get();
        return $applicantEducations;
    }


}
