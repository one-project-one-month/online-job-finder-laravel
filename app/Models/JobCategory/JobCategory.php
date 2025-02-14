<?php

namespace App\Models\JobCategory;


use Illuminate\Database\Eloquent\Model;
use Reshadman\OptimisticLocking\OptimisticLocking;

class JobCategory extends Model
{
    use OptimisticLocking;
    
    protected $fillable =['industry','description'];

    public function optimisticLockColumn(): string
    {
        return 'lock_version';
    }
}
