<?php
namespace App\Repositories\Resumes;

use App\Models\Application\Application;
use App\Models\Resumes\Resume;

class ResumeRepository
{

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
        $newResume = 'storage/' . $file->store('resumes', 'public');
        $resume    = $resume->update([
            'user_id'   => $userId,
            'file_path' => $newResume,
        ]);
        return $resume;
    }

    public function delete($id)
    {
        $Resume           = Resume::findOrFail($id);
        $existApplication = Application::where('resume_id', $id)->first();
        if ($existApplication) {
            throw new \Exception("You can't delete this resume");
        }
        $Resume->delete();
        return $Resume;
    }
}
