<?php

namespace App\Repositories\Resumes;

use App\Models\Resumes\Resume;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

 class ResumeRepository {


    public function create($user_id, UploadedFile $data)
    {
        $filePath = '/storage/'. $data->store('resumes', 'public');
             $resume= Resume::create([
            'user_id' => $user_id,
            'file_path' => $filePath,
        ]);

        return $resume;
    }

    public function all () {
        $resume= Resume::all();
         return $resume;
     }


    public function find($id)
    {
        $resume= Resume::findOrFail($id);
        return $resume;
    }

    public function update($userId,$file,$resumeId){
        $resume = Resume::where('id',$resumeId)->first();
        $newResume='storage/'.$file->store('resumes','public');
        $resume=$resume->update([
            'user_id'=>$userId,
            'file_path'=>$newResume
        ]);
        return $resume;
    }

    public function delete($id){
        $Resume=Resume::findOrFail($id);
        $Resume->delete();
        return $Resume;
    }
 }
