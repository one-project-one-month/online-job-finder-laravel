<?php
namespace App\Services\Resumes;

use App\Repositories\Resumes\ResumeRepository;
use Illuminate\Support\Facades\Storage;

class ResumeService
{

    protected $resumeRepository;

    public function __construct(ResumeRepository $resumeRepository)
    {
        $this->resumeRepository = $resumeRepository;
    }

    public function createResume($data)
    {
        return $this->resumeRepository->create($data);
    }

    public function getAllResumes()
    {

        return $this->resumeRepository->all();
    }

    public function getResumeById($id)
    {
        return $this->resumeRepository->find($id);
    }

    public function getDefaultResume()
    {
        return $this->resumeRepository->getDefaultResume();
    }

    public function updateResume($userId, $file, $resumeId)
    {
        $existResume = $this->getResumeById($resumeId);
        if ($existResume) {
            $filePath = str_replace('/storage/', '', $existResume->file_path);
            if (Storage::exists($filePath)) {
                Storage::delete($filePath);
            }

        }

        return $this->resumeRepository->update($userId, $file, $resumeId);

    }

    public function deleteResume($resume)
    {
        $filePath = str_replace('/storage/', '', $resume->file_path);
        if (Storage::exists($filePath)) {
            Storage::delete($filePath);
        }
        return $this->resumeRepository->delete($resume->id);
    }
}
