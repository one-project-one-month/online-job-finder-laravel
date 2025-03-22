<?php
namespace App\Services\Resumes;

use App\Repositories\Resumes\ResumeRepository;
use App\Services\Storage\StorageService;
use Illuminate\Support\Facades\Storage;

class ResumeService
{

    protected $resumeRepository;
    protected $storageService;

    public function __construct(ResumeRepository $resumeRepository,StorageService $storageService)
    {
        $this->resumeRepository = $resumeRepository;
        $this->storageService = $storageService;
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
        $path = str_replace(url('uploads') . '/', '', $existResume->file_path);
            $this->storageService->delete($path);
        }

        return $this->resumeRepository->update($userId, $file, $resumeId);

    }

    public function deleteResume($resume)
    {
        return $this->resumeRepository->delete($resume->id);
    }
}
