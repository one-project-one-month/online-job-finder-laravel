<?php

namespace App\Models\Resumes;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Reshadman\OptimisticLocking\OptimisticLocking;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Resume extends Model
{
    use OptimisticLocking,  HasFactory;
    protected $fillable =['user_id','file_path',];

    public function optimisticLockColumn(): string
    {
        return 'lock_version';
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
