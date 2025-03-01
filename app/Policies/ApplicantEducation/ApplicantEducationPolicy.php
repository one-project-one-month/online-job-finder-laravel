<?php

namespace App\Policies\ApplicantEducation;

use App\Models\ApplicantProfile\ApplicantProfile;
use App\Models\User;
use Illuminate\Auth\Access\Response;
use App\Models\ApplicantEducation\ApplicantEducation;

class ApplicantEducationPolicy
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
    public function view(User $user, ApplicantEducation $applicantEducation): bool
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
    public function update(User $user,$id): bool
    {
        $applicant=ApplicantProfile::where('user_id',$user->id)->first();
        $applicantEducation=ApplicantEducation::where('id',$id)->first();
        if (!$applicantEducation) {
            return false;
        }
        return $applicant->id === $applicantEducation->applicant_id;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user,  $id): bool
    {
        $applicant=ApplicantProfile::where('user_id',$user->id)->first();
        $applicantEducation=ApplicantEducation::where('id',$id)->first();
        if (!$applicantEducation) {
            return false;
        }
        return $applicant->id === $applicantEducation->applicant_id;
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, ApplicantEducation $applicantEducation): bool
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, ApplicantEducation $applicantEducation): bool
    {
        return false;
    }
}
