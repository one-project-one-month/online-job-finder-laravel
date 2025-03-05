<?php
namespace App\Services\CompanyProfile;

use App\Repositories\CompanyProfile\CompanyProfileRepository;

class CompanyProfileServices
{
    protected $companyProfileRepository;

    public function __construct(CompanyProfileRepository $companyProfileRepository)
    {
        $this->companyProfileRepository = $companyProfileRepository;
    }

    public function createCompanyProfile($validatedData)
    {

        $companyProfile = $this->companyProfileRepository->create($validatedData);

        return $companyProfile;
    }

    public function GetAllCompanyProfile($request)
    {
        // Get all company profiles
        $companyProfiles = $this->companyProfileRepository->all($request);

        return $companyProfiles;
    }

    public function getMyCompanyProfile($user_id)
    {
        return $this->companyProfileRepository->getMyCompanyProfile($user_id);
    }

    public function getCompanyProfileById($id)
    {
        $companyProfile = $this->companyProfileRepository->find($id);

        return $companyProfile;
    }

    public function updateMyCompanyProfile($user_id, $validatedData)
    {
        return $this->companyProfileRepository->updateByUserId($user_id, $validatedData);
    }

    public function DeleteCompanyProfile($id)
    {
        // Delete company profile
        $companyProfile = $this->companyProfileRepository->delete($id);

        return $companyProfile;
    }

    public function getJobs($id){
        return $this->companyProfileRepository->getJobs($id);
    }
}
