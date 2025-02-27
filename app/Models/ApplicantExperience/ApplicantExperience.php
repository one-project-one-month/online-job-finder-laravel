<?php

namespace App\Models\ApplicantExperience;

use App\Models\ApplicantProfile\ApplicantProfile;
use Illuminate\Database\Eloquent\Model;
use Reshadman\OptimisticLocking\OptimisticLocking;

class ApplicantExperience extends Model

{
    use OptimisticLocking;

    protected $fillable = [
        'applicant_id',
        'company_name',
        'location',
        'title',
        'description',
        'job_type',
        'start_date',
        'end_date',
        'currently_working',
        'lock_version'
    ];

    public function optimisticLockColumn(): string
    {
        return 'lock_version';
    }

    public function applicant(){
        return $this->belongsTo(ApplicantProfile::class);
    }



}
