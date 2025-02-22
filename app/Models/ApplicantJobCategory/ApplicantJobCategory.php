<?php

namespace App\Models\ApplicantJobCategory;

use App\Models\JobCategory\JobCategory;
use Illuminate\Database\Eloquent\Model;
use App\Models\ApplicantProfile\ApplicantProfile;
use Reshadman\OptimisticLocking\OptimisticLocking;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ApplicantJobCategory extends Model
{
    use HasFactory, OptimisticLocking;

     // Explicitly define the table name
    protected $table = 'applicant_job_categories';

     // Fillable attributes to allow mass-assignment
    protected $fillable = [
        'applicant_id',
        'job_category_id',
        'lock_version',
    ];

      // Timestamps are handled automatically
    public $timestamps = true;

    public function applicantProfile () {
        return $this->belongsTo(ApplicantProfile::class,'applicant_id');
    }

    public function jobCategory () {
        return $this->belongsTo(JobCategory::class,'job_category_id');
    }

    public function optimisticLockColumn(): string
    {
        return 'lock_version';
    }
}



