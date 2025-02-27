<?php

namespace App\Services\ApplicantEducation;

use App\Models\ApplicantEducation\ApplicantEducation;
use App\Models\ApplicantProfile\ApplicantProfile;
use App\Repositories\ApplicantEducation\ApplicantEducationRepository;
use Carbon\Carbon;

class ApplicantEducationService
{
    protected $applicantEducationRepository;
   public function __construct(ApplicantEducationRepository $applicantEducationRepository)
   {
        $this->applicantEducationRepository = $applicantEducationRepository;
   }

   public function create(array $data)
   {
        $user = auth()->user();
        $applicant = ApplicantProfile::where('user_id',$user->id)->first();

        if (isset($data['start_date'])) {
            $data['start_date'] =  Carbon::parse($data['start_date'])->toDateString();
        }

        if (isset($data['end_date'])) {
            $data['end_date'] =  Carbon::parse($data['end_date'])->toDateString();
        }

        $data['applicant_id'] = $applicant->id;
        $applicantEducation=ApplicantEducation::where('applicant_id',$applicant->id)->first();
        if ($applicantEducation) {
            throw new \Exception("Applicant education already created");
        }
        return $this->applicantEducationRepository->create($data);
   }

   public function update(array $data,$id)
   {
    return $this->applicantEducationRepository->update($data,$id);
   }

   public function destroy($id)
   {
    return $this->applicantEducationRepository->delete($id);
   }

   public function show($id)
   {
    return $this->applicantEducationRepository->show($id);
   }

   public function getAll()
   {
    return $this->applicantEducationRepository->getAll();
   }
}
