<?php

namespace App\Models\Locations;

use Illuminate\Database\Eloquent\Model;
use Reshadman\OptimisticLocking\OptimisticLocking;

class Location extends Model
{
    use OptimisticLocking;
    protected $fillable =['name','description','lock_version'];

    public function optimisticLockColumn(): string
    {
        return 'lock_version';
    }
}
