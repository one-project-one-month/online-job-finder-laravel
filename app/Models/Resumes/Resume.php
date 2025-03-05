<?php
namespace App\Models\Resumes;

use App\Models\User;
use App\Services\Storage\StorageService;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Reshadman\OptimisticLocking\OptimisticLocking;

class Resume extends Model
{
    use OptimisticLocking, HasFactory;
    protected $fillable = ['user_id', 'name', 'file_path', 'is_default'];

    public function optimisticLockColumn(): string
    {
        return 'lock_version';
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getFilePathAttribute($value)
    {

        return $value ? StorageService::getUrl($value) : null;
    }
}
