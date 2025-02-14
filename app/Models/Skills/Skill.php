<?php

namespace App\Models\Skills;

use Illuminate\Database\Eloquent\Model;
use Reshadman\OptimisticLocking\OptimisticLocking;

class Skill extends Model
{
    use OptimisticLocking;
    protected $fillable =['name','description','lock_version'];

    public function optimisticLockColumn(): string
    {
        return 'lock_version';
    }
}
