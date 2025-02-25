<?php

namespace App\Models\JobSkill;

use App\Models\Job\JobPost;
use App\Models\Skills\Skill;
use Illuminate\Database\Eloquent\Model;

class JobSkill extends Model
{
    protected $fillable=['skill_id','job_post_id'];

    public function jobPost(){
        return $this->belongsTo(JobPost::class);
    }

    public function skill(){
        return $this->belongsTo(Skill::class);
    }
}
