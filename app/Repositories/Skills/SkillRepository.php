<?php

namespace App\Repositories\Skills;

use App\Models\Skills\Skill;

class SkillRepository{

    public function create(array $data)
    {
        return Skill::create($data);
    }

    public function find($id)
    {
        return Skill::findOrFail($id);
    }

    public function destroy($id)
    {
        $skill = Skill::findorFail($id);
        $skill->delete();
        return $skill;
    }

    public function update(array $data, $id)
    {
        $skill = Skill::findOrFail($id);
        $skill->update($data);
        return $skill;
    }

    public function all()
    {
        $skills = Skill::all();
        return $skills;
    }


}
