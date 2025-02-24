<?php

namespace App\Repositories\Application;

use App\Models\Application\Application;

class ApplicationRepository{

    public function create($data){
        $application=Application::create($data);
        return $application;
    }

    public function get(){
        $applications=Application::get();
        return $applications;
    }

    public function show($id){
        $application=Application::findOrFail($id);
        return $application;
    }

    public function update($data,$id){
        $application=Application::findOrFail($id);
        $application->update($data);
        return $application;
    }

    public function delete($id){
        $application=Application::findOrFail($id);
        $application->delete();
        return $application;
    }


}
