<?php

namespace App\Models\ApplicantExperience;

use Illuminate\Database\Eloquent\Model;

class ApplicantExperience extends Model
{
    protected $table = 'applicant_experiences';

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
        'version'
    ];

}
