<?php

namespace App\Repositories\Resumes;

use App\Models\Resumes\Resume;
use App\Repositories\Resumes\ResumeRepository;

 class ResumeRepository {


    public function create( array $data){

        dd($data);

        $resume = Resume::create($data);
        return $resume;
    }

    public function all () {
        $resume= Resume::all();
         return $resume;
     }


    public function find($id)
    {
        return Resume::findOrFail($id);
    }

    public function update(array $data , $id){
        $Resume = Resume::findOrFail($id);
        $Resume->update($data);
        return $Resume;
    }

    public function delete($id){
        $Resume=Resume::findOrFail($id);
        $Resume->delete();
        return $Resume;
    }
 }



?>
