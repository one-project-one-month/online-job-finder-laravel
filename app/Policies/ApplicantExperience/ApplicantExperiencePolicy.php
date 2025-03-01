<?php

namespace App\Policies\ApplicantExperience;

use App\Models\User;
use Illuminate\Auth\Access\Response;
use App\Models\ApplicantProfile\ApplicantProfile;
use App\Models\ApplicantExperience\ApplicantExperience;

class ApplicantExperiencePolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return false;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, ApplicantExperience $applicantExperience): bool
    {
        return false;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return false;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user,  $id): bool
    {
        $applicant=ApplicantProfile::where('user_id',$user->id)->first();
        $applicantExperience=ApplicantExperience::where('id',$id)->first();
        if (!$applicantExperience) {
            return false;
        }
        return $applicant->id === $applicantExperience->applicant_id;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, ApplicantExperience $applicantExperience): bool
    {
        return false;
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, ApplicantExperience $applicantExperience): bool
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, ApplicantExperience $applicantExperience): bool
    {
        return false;
    }
}
