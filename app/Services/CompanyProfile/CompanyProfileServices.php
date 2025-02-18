<?php

namespace App\Services\CompanyProfile;
use App\Http\Resources\CompanyProfileResource;
use App\Repositories\CompanyProfile\CompanyProfileRepositories;

class CompanyProfileServices
{
    protected $companyProfileRepositories;

    // Constructor to inject the repository
    public function __construct(CompanyProfileRepositories $companyProfileRepositories)
    {
        $this->companyProfileRepositories = $companyProfileRepositories;
    }

    public function createCompanyProfile($validatedData)
    {
        // Get the user ID from the authenticated user
        $user = auth()->user()->id; // Fetches the authenticated user's ID

        // Add the user_id to validated data
        $validatedData['user_id'] = $user;

        // Create a new company profile
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

    public function UpdateCompanyProfile($validatedData, $id)
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
  
