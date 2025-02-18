<?php

namespace App\Models\CompanyProfile;

use App\Models\User;
use App\Models\Locations\Location;
use Illuminate\Database\Eloquent\Model;
use Reshadman\OptimisticLocking\OptimisticLocking;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CompanyProfile extends Model
{
    use HasFactory, OptimisticLocking;

    protected $table = 'company_profiles';

    protected $fillable = [
        'user_id',
        'company_name',
        'phone',
        'website',
        'address',
        'location_id',
        'description',
        'lock_version',
    ];

    /**
     * Define relationship with User model.
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * Define relationship with Location model.
     */
    public function location()
    {
        return $this->belongsTo(Location::class, 'location_id');
    }

    public function optimisticLockColumn(): string
    {
        return 'lock_version';
    }
}
