<?php
namespace App\Repositories\Review;

use App\Models\ApplicantProfile\ApplicantProfile;
use App\Models\Review\Review;

class ReviewRepository
{
    public function getAll($request)
    {
        return Review::with('applicant')
            ->where(function ($query) use ($request) {
                if ($request->company_id) {
                    $query->where('company_id', $request->company_id);
                }
            })
            ->latest()->get();
    }

    public function create($data)
    {
        $user      = auth()->user()->id;
        $applicant = ApplicantProfile::where('user_id', $user)->first();

        $data['applicant_id'] = $applicant->id;
        $review               = Review::create($data);
        return $review;
    }

    public function show($id)
    {
        return Review::with('applicant')->findOrFail($id);
    }

    public function update($data, $id)
    {
        $review = Review::findOrFail($id);
        $review->update($data);

        return $review;
    }

    public function delete($id)
    {
        $review = Review::findOrFail($id);
        $review->delete();
        return $review;
    }

}
