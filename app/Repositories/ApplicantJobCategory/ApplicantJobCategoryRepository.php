<?php 

namespace App\Repositories\ApplicantJobCategory;

use App\Models\ApplicantJobCategory\ApplicantJobCategory;
use Illuminate\Support\Facades\Auth;

class ApplicantJobCategoryRepository
{
    public function create ($data)
    {
        $user_id = Auth::user()->id;
        $data['applicant_id'] = $user_id;
        return ApplicantJobCategory::create(['applicant_id' => $data->applicant_id , 'job_category_id' => $data->job_category_id]);
    }
}