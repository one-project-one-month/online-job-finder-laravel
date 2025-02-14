<?php

namespace App\Services\Skills;

use App\Models\Skills\Skill;
use App\Repositories\Skills\SkillRepository;

class SkillService{
    protected $skillRepo;

    public function __construct(SkillRepository $skillRepo)
    {
        $this->skillRepo = $skillRepo;
    }

    public function createSkill(array $data)
    {
        return $this->skillRepo->create($data);
    }

    public function findSkill($id)
    {
        return $this->skillRepo->find($id);
    }

    public function destroySkill($id)
    {
        return $this->skillRepo->destroy($id);
    }

    public function updateSkill(array $data, $id)
    {
        return $this->skillRepo->update($data, $id);
    }

    public function getAllSkills()
    {
        return $this->skillRepo->all();
    }



}

