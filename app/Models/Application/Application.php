<?php

namespace App\Models\Application;

use App\Models\ApplicantProfile\ApplicantProfile;
use App\Models\Job\JobPost;
use App\Models\Resumes\Resume;
use Illuminate\Database\Eloquent\Model;
use Reshadman\OptimisticLocking\OptimisticLocking;

class Application extends Model
{
    use OptimisticLocking;
    protected $fillable=['job_post_id','applicant_id','status','resume_id','lock_version','applied_at'];

    public function optimisticLockColumn(): string
    {
        return 'lock_version';
    }

    public function resume(){
        return $this->belongsTo(Resume::class);
    }

    public function applicant(){
        return $this->belongsTo(ApplicantProfile::class);
    }

    public function jobPost(){
        return $this->belongsTo(JobPost::class);
    }
}
