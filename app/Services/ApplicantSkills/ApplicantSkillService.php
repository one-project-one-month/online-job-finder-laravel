<?php

namespace App\Services\ApplicantSkills;

use App\Repositories\ApplicantSkills\ApplicantSkillRepository;

class ApplicantSkillService
{

    protected $applicantSkillRepository;
    public function __construct(ApplicantSkillRepository $applicantSkillRepository)
    {
        $this->applicantSkillRepository = $applicantSkillRepository;
    }

    public function create( $data)
    {
        
       
        
        return $this->applicantSkillRepository->create($data);
    }

    public function getAll()
    {
        return $this->applicantSkillRepository->getAll();
    }

    public function show($id)
    {

        return $this->applicantSkillRepository->show($id);
    }

    public function  update( $data, $id)
    {   
        
        
        return $this->applicantSkillRepository->update($data, $id);
    }

    public function delete($id)
    {

        return $this->applicantSkillRepository->delete($id);
    }
}
