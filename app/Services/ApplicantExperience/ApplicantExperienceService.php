<?php

namespace App\Services\ApplicantExperience;


use App\Repositories\ApplicantExperience\ApplicantExperienceRepository;


class ApplicantExperienceService
{
    protected $ApplicantExperienceRepository;
   public function __construct(ApplicantExperienceRepository $ApplicantExperienceRepository)
   {
        $this->ApplicantExperienceRepository = $ApplicantExperienceRepository;
   }

   public function create(array $data)
   {

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
