<?php

namespace App\Models\SavedJob;

use App\Models\ApplicantProfile\ApplicantProfile;
use App\Models\Job\JobPost;
use Illuminate\Database\Eloquent\Model;
use Reshadman\OptimisticLocking\OptimisticLocking;

class SavedJob extends Model
{
    use OptimisticLocking;
    protected $fillable=['applicant_id','job_post_id','lock_version'];

    public function optimisticLockColumn(): string
    {
        return 'lock_version';
    }

    public function applicant()
    {
        return $this->belongsTo(ApplicantProfile::class);
    }

    public function jobPost()
    {
        return $this->belongsTo(JobPost::class);
    }


}
