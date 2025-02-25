<?php

namespace App\Repositories\ApplicantExperience;

use App\Models\ApplicantEducation\ApplicantExperience;

class ApplicantExperienceRepository
{
    public function create(array $data){
      return ApplicantExperience::create($data);
    }

    public function update(array $data,$id){
        $ApplicantExperience = ApplicantExperience::findOrFail($id);
        $ApplicantExperience->update($data);
        return $ApplicantExperience;
    }

    public function delete($id){
        $ApplicantExperience = ApplicantExperience::findOrFail($id);
        $ApplicantExperience->delete();
        return $ApplicantExperience;
    }

    public function show($id){
        return ApplicantExperience::findOrFail($id);
    }

    public function getAll(){
        $ApplicantExperiences = ApplicantExperience::latest()->get();
        return $ApplicantExperiences;
    }

}
