<?php

namespace App\Services\ApplicantExperience;

use App\Models\ApplicantProfile\ApplicantProfile;
use App\Repositories\ApplicantExperience\ApplicantExperienceRepository;
use Carbon\Carbon;

class ApplicantExperienceService
{
    protected $ApplicantExperienceRepository;
   public function __construct(ApplicantExperienceRepository $ApplicantExperienceRepository)
   {
        $this->ApplicantExperienceRepository = $ApplicantExperienceRepository;
   }

   public function create(array $data)
   {
        $user = auth()->user()->id;
        $applicant = ApplicantProfile::where('user_id',$user)->first();

        if (isset($data['start_date'])) {
            $data['start_date'] =  Carbon::parse($data['start_date'])->toDateString();
        }

        if (isset($data['end_date'])) {
            $data['end_date'] =  Carbon::parse($data['end_date'])->toDateString();
        }

        $data['applicant_id'] = $applicant->id;
        return $this->ApplicantExperienceRepository->create($data);
   }

   public function update(array $data,$id)
   {
    return $this->ApplicantExperienceRepository->update($data,$id);
   }

   public function destroy($id)
   {
    return $this->ApplicantExperienceRepository->delete($id);
   }

   public function show($id)
   {
    return $this->ApplicantExperienceRepository->show($id);
   }

   public function getAll()
   {
    return $this->ApplicantExperienceRepository->getAll();
   }
}
