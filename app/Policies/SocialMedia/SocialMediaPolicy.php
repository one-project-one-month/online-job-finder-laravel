<?php

namespace App\Policies\SocialMedia;

use App\Models\User;
use Illuminate\Auth\Access\Response;
use App\Models\SocialMedia\SocialMedia;

class SocialMediaPolicy
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
    public function view(User $user, SocialMedia $socialMedia): bool
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
    public function update(User $user, $id): bool
    {
        $socialMedia=SocialMedia::where('id',$id)->first();
        if (!$socialMedia) {
            return false;
        }
        return $user->id === $socialMedia->user_id;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, $id): bool
    {
        $socialMedia=SocialMedia::where('id',$id)->first();
        if (!$socialMedia) {
            return false;
        }
        return $user->id === $socialMedia->user_id;
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
