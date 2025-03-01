<?php
namespace App\Models\ApplicantProfile;

use App\Models\JobCategory\JobCategory;
use App\Models\Locations\Location;
use App\Models\Skills\Skill;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Reshadman\OptimisticLocking\OptimisticLocking;

class ApplicantProfile extends Model
{
    use OptimisticLocking;

    protected $fillable = [
        'user_id',
        'full_name',
        'phone',
        'address',
        'location_id',
        'description',
    ];

    public function optimisticLockColumn(): string
    {
        return 'lock_version';
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function location()
    {
        return $this->belongsTo(Location::class);
    }

    public function skills()
    {
        return $this->belongsToMany(Skill::class, 'applicant_skills', 'applicant_id', 'skill_id');
    }

    public function job_categories()
    {
        return $this->belongsToMany(JobCategory::class, 'applicant_job_categories', 'applicant_id','job_category_id' );
    }
}
