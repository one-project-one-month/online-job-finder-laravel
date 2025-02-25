<?php

namespace App\Models\SavedJob;

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


}
