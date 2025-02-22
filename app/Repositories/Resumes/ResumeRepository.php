<?php
namespace App\Repositories\Resumes;

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
        $Resume = Resume::findOrFail($id);
        $Resume->delete();
        return $Resume;
    }
}
