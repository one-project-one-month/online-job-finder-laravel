<?php
namespace App\Repositories\SocialMedia;

use App\Models\SocialMedia\SocialMedia;

class SocialMediaRepository
{
    public function index($request)
    {
        return SocialMedia::where(function ($query) use ($request) {
            if ($request->user_id) {
                $query->where('user_id', $request->user_id);
            }
        })
            ->get();
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

    public function delete($id)
    {
        $socialMedia = SocialMedia::findOrFail($id);
        $socialMedia->delete();
        return $socialMedia;
    }
}
