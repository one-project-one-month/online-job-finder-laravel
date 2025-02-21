<?php

namespace App\Models\ApplicantEducation;
use Reshadman\OptimisticLocking\OptimisticLocking;


use Illuminate\Database\Eloquent\Model;

class ApplicantEducation extends Model
{

    use OptimisticLocking;

    protected $table = 'applicant_educations';


    protected $fillable = [
        'applicant_id',
        'school_name',
        'degree',
        'field_of_study',
        'description',
        'start_date',
        'end_date',
        'still_attending',
        'lock_version'
    ];

    public function optimisticLockColumn(): string
    {
        return 'lock_version';
    }
}
