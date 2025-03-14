<?php
namespace App\Repositories;

use App\Models\SocialMedia\SocialMedia;

class UserRepository
{
    public function index($request)
    {
        
    }

    public function create($data)
    {
        $socialMedia = SocialMedia::create($data);

        return $socialMedia;
    }

    public function find($id)
    {
        $socialMedia = SocialMedia::findOrFail($id);
        
        return $socialMedia;
    }

    public function update($data, $id)
    {

        $socialMedia = SocialMedia::findOrFail($id);
        $socialMedia->update($data);

        return $socialMedia;
    }

    public function updateProfile($profile_photo, $id)
    {

        $socialMedia = SocialMedia::findOrFail($id);
        $socialMedia->update($data);

        return $socialMedia;
    }

    public function delete($id)
    {
        $socialMedia = SocialMedia::findOrFail($id);
        $socialMedia->delete();
        return $socialMedia;
    }
}
