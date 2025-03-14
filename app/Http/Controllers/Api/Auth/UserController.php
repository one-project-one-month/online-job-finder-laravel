<?php
namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use App\Models\User;
use App\Services\Storage\StorageService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    private $storageService;

    public function __construct(StorageService $storageService)
    {
        $this->storageService = $storageService;
    }

    public function uploadProfile(Request $request)
    {
        $request->validate([
            'profile_photo' => 'required|mimes:jpeg,png,jpg,gif,svg',
        ]);

        $user                = auth()->user();
        $filePath            = $this->storageService->store('profile_pictures', $request->file('profile_photo'));
        $user->profile_photo = $filePath;
        $user->save();

        $user = User::with('role')->findOrFail($user->id);

        return response()->json(
            [
                'status'     => 'success',
                'statusCode' => 201,
                'message'    => 'Profile photo uploaded successfully',
                'data'       => [
                    'user' => new UserResource($user),
                ],
            ], 201
        );

    }
}
