<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Requests\PasswordChangeRequest;
use App\Http\Requests\LoginRequest;
use App\Http\Resources\LoginResource;
use App\Http\Resources\RegisterResource;
use App\Http\Resources\UserResource;
use App\Models\User;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\RegisterRequest;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Facades\JWTAuth;

class AuthController extends Controller
{
    public function register(RegisterRequest $request){
        return 'gg';
        try {
            $user=User::create([
                'username'=>$request->username,
                'email'=>$request->email,
                'password'=>Hash::make($request->password),
                'role_id'=>$request->role_id,
            ]);

            $role=Role::where('id',$request->role_id)->where('guard_name','api')->first();
            if ($role) {
                $user->assignRole($role);
            }
            $user=User::with('role')->find($user->id);

            return response()->json([
                'message'=>'User Created Successful',
                'status'=>'success',
                'data'=>[
                    'user'=>new UserResource($user)
                ]
                ]);

        } catch (\Exception $e) {
            return response()->json([
                'message'=>$e->getMessage(),
                'status'=>'error',
            ],500);
        }
    }

    public function login(LoginRequest $request){
       try {
        $user = User::with('role')->where('email', $request->email)->first();

        if (!$user) {
           return response()->json([
            'message'=>'user not found',
            'status'=>'error'
           ],404);
        }
        if (!Hash::check($request->password, $user->password)) {
            return response()->json([
                'error' => 'Invalid password.'
            ], 401);
        }

        $token = JWTAuth::fromUser($user);

        return response()->json([
            'message'=>'user login successful',
            'status'=>'success',
           'data'=>[
            'user'=>new UserResource($user),
            'token'=>$token
           ],


        ]);
       } catch (\Exception $e) {
        return response()->json([
            'message'=>$e->getMessage(),
            'status'=>'error'
        ],500);
       }
    }

    public function getUser(){
       try {
        $user=JWTAuth::parseToken()->authenticate();
        if (!$user) {
            return response()->json([
                'Message'=>'User not found',
                'status'=>'error'
            ],404);
        }
        return response()->json([
            'message'=>'fetching user success',
            'status'=>'success',
            'data'=>[
                'user'=>new UserResource($user)
            ]
        ]);
       } catch (JWTException $e) {
       return response()->json([
        'message'=>$e->getMessage(),
        'status'=>'error'
       ]);
       }
    }

    public function logout(){
        JWTAuth::invalidate(JWTAuth::getToken());
        return response()->json([
            'message'=>'Signout successful'
        ]);
    }

    public function changePassword(PasswordChangeRequest $request){
        $user =User::with('role')->where('id',auth()->user()->id)->first();

        if (!Hash::check($request->current_password, $user->password)) {
            return response()->json([
                'message' => 'Current password is incorrect',
                'status' => 'error',
            ], 400);
        }

        $user->password = Hash::make($request->new_password);
        $user->save();

        JWTAuth::invalidate(JWTAuth::getToken());
        $newToken = JWTAuth::fromUser($user);

        return response()->json([
            'message'=>'Password changed successfully',
            'status'=>'success',
            'data'=>[
                'user'=>new UserResource($user),
                'token'=>$newToken
            ],
        ], 200);
    }
}
