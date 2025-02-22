<?php

namespace App\Services\CompanyProfile;
use App\Repositories\CompanyProfile\CompanyProfileRepositories;

class CompanyProfileServices
{
    protected $companyProfileRepositories;

    public function __construct(CompanyProfileRepositories $companyProfileRepositories)
    {
        $this->companyProfileRepositories = $companyProfileRepositories;
    }

    public function createCompanyProfile($validatedData)
    {

        $companyProfile = $this->companyProfileRepositories->create($validatedData);

        return $companyProfile;
    }

    public function GetAllCompanyProfile ()
    {
        // Get all company profiles
        $companyProfiles = $this->companyProfileRepositories->all();

        return $companyProfiles;
    }

    public function GetCompanyProfileById($id)
    {
        // Get company profile by ID
        $companyProfile = $this->companyProfileRepositories->find($id);

        return $companyProfile;
    }

    public function updateCompanyProfile($validatedData, $id)
    {
        // Update company profile
        $companyProfile = $this->companyProfileRepositories->update($validatedData, $id);

        return $companyProfile;
    }

    public function DeleteCompanyProfile($id)
    {
        // Delete company profile
        $companyProfile = $this->companyProfileRepositories->delete($id);

        return $companyProfile;
    }
}

