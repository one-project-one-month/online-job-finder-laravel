<?php
namespace App\Repositories\Resumes;

use App\Models\Application\Application;
use App\Models\Resumes\Resume;
use App\Services\Storage\StorageService;
use Storage;

class ResumeRepository
{
    protected $storageService;
    public function __construct(StorageService $storageService){
        $this->storageService=$storageService;
    }

    public function create($data)
    {
        $resume = Resume::create([
            'user_id'    => $data['user_id'],
            'name'       => $data['name'],
            'file_path'  => $data['file_path'],
            'is_default' => $data['is_default'] ?? false,
        ]);

        if ($data['is_default'] == true) {
            Resume::where('user_id', $data['user_id'])->whereNot('id', $resume->id)->update([
                'is_default' => false,
            ]);
        }

        return $resume;
    }

    public function all()
    {
        $resume = Resume::all();
        return $resume;
    }

    public function find($id)
    {
        $resume = Resume::findOrFail($id);
        return $resume;
    }

    public function getDefaultResume()
    {
        $resume = Resume::where('is_default', true)->firstOrFail();
        return $resume;
    }

    public function update($userId, $file, $resumeId)
    {
        $resume    = Resume::where('id', $resumeId)->first();
       $newResume= $this->storageService->store('resumes', $file);
       $name      = $file->getClientOriginalName();
        $resume    = $resume->update([
            'user_id'   => $userId,
            'file_path' => $newResume,
            'name'=>$name
        ]);
        return $resume;
    }

    public function delete($id)
    {
        $resume= Resume::findOrFail($id);
        $existApplication = Application::where('resume_id', $id)->first();
        if ($existApplication) {
            throw new \Exception("You can't delete this resume");
        }
        $path = str_replace(url('uploads') . '/', '', $resume->file_path);
        $this->storageService->delete($path);
        $resume->delete();
        return $resume;
    }
}
