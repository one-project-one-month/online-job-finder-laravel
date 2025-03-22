<?php
namespace App\Policies;

use App\Models\ApplicantProfile\ApplicantProfile;
use App\Models\Resumes\Resume;
use App\Models\Review\Review;
use App\Models\SocialMedia\SocialMedia;
use App\Models\User;

class ReviewPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return true;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, SocialMedia $socialMedia): bool
    {
        return true;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return true;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user ,$id): bool
    {
        $resume=Resume::findOrFail($id);
       return $user->id===$resume->user_id;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user,$id): bool
    {
        $resume=Resume::findOrFail($id);
           return $user->id===$resume->user_id;
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, SocialMedia $socialMedia): bool
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, SocialMedia $socialMedia): bool
    {
        return false;
    }
}
