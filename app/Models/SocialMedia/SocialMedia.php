<?php

namespace App\Models\SocialMedia;

use Illuminate\Database\Eloquent\Model;
use Reshadman\OptimisticLocking\OptimisticLocking;

class SocialMedia extends Model
{
    use OptimisticLocking;
    protected $fillable=['user_id','link'];

    public function optimisticLockColumn(): string
    {
        return 'lock_version';
    }
}
