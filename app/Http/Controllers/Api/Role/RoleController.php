<?php

namespace App\Http\Controllers\Api\Role;

use App\Http\Controllers\Controller;
use App\Http\Resources\Role\RoleResource;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    public function index(){
       $roles= Role::all();
       return response()->json([
        'message'=>'Roles fetched successfully',
        'statusCode'=>200,
        'status'=>200,
        'data'=>[
            'roles'=>RoleResource::collection($roles)
        ]
        ]);
    }
}
