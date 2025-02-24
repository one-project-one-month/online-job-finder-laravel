<?php

namespace App\Models\Job;

use App\Models\Locations\Location;
use App\Models\JobCategory\JobCategory;
use Illuminate\Database\Eloquent\Model;
use Reshadman\OptimisticLocking\OptimisticLocking;

class JobPost extends Model
{
    use OptimisticLocking;
    protected $fillable=['company_id','title','job_category_id','location_id','type','description','requirements','num_of_posts','salary','address','status','lock_version'];


    public function optimisticLockColumn(): string
    {
        return 'lock_version';
    }

    public function location(){
        return $this->belongsTo(Location::class);
    }

    public function jobCategory(){
        return $this->belongsTo(JobCategory::class);
    }
}
