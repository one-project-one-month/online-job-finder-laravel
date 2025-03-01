<?php
namespace App\Models\Review;

use App\Models\ApplicantProfile\ApplicantProfile;
use App\Models\CompanyProfile\CompanyProfile;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Reshadman\OptimisticLocking\OptimisticLocking;

class Review extends Model
{
    use OptimisticLocking;

    protected $fillable = ['applicant_id', 'company_id', 'comment', 'rating'];

    public function optimisticLockColumn(): string
    {
        return 'lock_version';
    }

    public function applicant()
    {
        return $this->belongsTo(ApplicantProfile::class, 'applicant_id');
    }

    public function company()
    {
        return $this->belongsTo(CompanyProfile::class, 'company_id');
    }
}
