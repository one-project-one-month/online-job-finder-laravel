<?php

namespace App\Models\ApplicantSkills;

use App\Models\ApplicantProfile\ApplicantProfile;
use App\Models\Skills\Skill;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Reshadman\OptimisticLocking\OptimisticLocking;

class ApplicantSkill extends Model
{
    /** @use HasFactory<\Database\Factories\ApplicantSkills\ApplicantSkillFactory> */
    use HasFactory, OptimisticLocking;

    protected $fillable = [
        'applicant_id','skill_id'
    ];

    public function optimisticLockColumn(): string
    {
        return 'lock_version';
    }

    public function applicantProfile () {
        return $this->belongsTo(ApplicantProfile::class,'applicant_id','id');
    }

    public function skill () {
        return $this->belongsTo(Skill::class,'skill_id','id');
    }
}
