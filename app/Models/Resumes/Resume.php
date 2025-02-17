<?php

namespace App\Models\Resumes;

use Illuminate\Database\Eloquent\Model;
use Reshadman\OptimisticLocking\OptimisticLocking;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Resume extends Model
{
    use OptimisticLocking,  HasFactory;
    protected $fillable =['user_id','file_path','lock_version'];

    public function optimisticLockColumn(): string
    {
        return 'lock_version';
    }
}
