<?php

namespace App\Models\Application;

use Illuminate\Database\Eloquent\Model;
use Reshadman\OptimisticLocking\OptimisticLocking;

class Application extends Model
{
    use OptimisticLocking;
    protected $fillable=['job_id','applicant_id','status','resume_id','lock_version','applied_at'];

    public function optimisticLockColumn(): string
    {
        return 'lock_version';
    }
}
