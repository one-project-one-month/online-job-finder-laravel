<?php
namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\PasswordChangeRequest;
use App\Http\Requests\RegisterRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Facades\JWTAuth;

class AuthController extends Controller
{
    public function register(RegisterRequest $request)
    {
        try {
            $user = User::create([
                'username' => $request->username,
                'email'    => $request->email,
                'password' => Hash::make($request->password),
                'role_id'  => $request->role_id,
            ]);

            $role = Role::where('id', $request->role_id)->where('guard_name', 'api')->first();

            if ($role) {
                $user->assignRole($role);
            }

            $user = User::with('role')->findOrFail($user->id);

            return response()->json([
                'message' => 'User Created Successful',
                'status'  => 'success',
                'data'    => [
                    'user' => new UserResource($user),
                ],
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'message' => $e->getMessage(),
                'status'  => 'error',
            ], 500);
        }
    }

    public function login(LoginRequest $request)
    {

        try {
            $user = User::with('role')->where('email', $request->email)->first();

            if (! $user) {
                return response()->json([
                    'message' => 'Your email or password could potentially be incorrect',
                    'status'  => 'error',
                ], 401);
            }

            if (! Hash::check($request->password, $user->password)) {
                return response()->json([
                    'message' => 'Your email or password could potentially be incorrect',
                    'status'  => 'error',
                ], 401);
            }

            $token = JWTAuth::fromUser($user);

            return response()->json([
                'message' => 'user login successful',
                'status'  => 'success',
                'data'    => [
                    'user'  => new UserResource($user),
                    'token' => $token,
                ],

            ]);
        } catch (\Exception $e) {
            return response()->json([
                'message' => $e->getMessage(),
                'status'  => 'error',
            ], 500);
        }
    }

    public function getUser()
    {
        try {
            $user = Auth::user();

            $user = User::with('role')->findOrFail($user->id);

            return response()->json([
                'message' => 'fetching user success',
                'status'  => 'success',
                'data'    => [
                    'user' => new UserResource($user),
                ],
            ]);
        } catch (JWTException $e) {
            return response()->json([
                'message' => $e->getMessage(),
                'status'  => 'error',
            ]);
        }
    }

    public function logout()
    {
        JWTAuth::invalidate(JWTAuth::getToken());

        return response()->json([
            'message' => 'Signout successful',
        ]);
    }

    public function changePassword(PasswordChangeRequest $request)
    {
        $user = User::with('role')->where('id', auth()->user()->id)->first();

        if (! Hash::check($request->current_password, $user->password)) {
            return response()->json([
                'message' => 'Current password is incorrect',
                'status'  => 'error',
            ], 400);
        }

        $user->password = Hash::make($request->new_password);
        $user->save();

        return response()->json([
            'message' => 'Password changed successfully. Login Back!',
            'status'  => 'success',
            'data'    => [
                'user'  => new UserResource($user),
            ],
        ], 200);
    }
}
