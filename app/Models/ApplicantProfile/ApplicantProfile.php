<?php

namespace App\Models\ApplicantProfile;

use App\Models\Locations\Location;
use Illuminate\Database\Eloquent\Model;
use Reshadman\OptimisticLocking\OptimisticLocking;

class ApplicantProfile extends Model
{
    use OptimisticLocking;

    protected $fillable = [
        'user_id',
        'full_name',
        'phone',
        'address',
        'location_id',
        'description'
    ];

    public function optimisticLockColumn(): string
    {
        return 'lock_version';
    }

    public function location(){
        return $this->belongsTo(Location::class);
    }
}
