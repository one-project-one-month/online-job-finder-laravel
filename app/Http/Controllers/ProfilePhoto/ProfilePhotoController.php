<?php

namespace App\Http\Controllers\ProfilePhoto;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProfilePhoto\ProfilePhotoRequest;
use App\Http\Resources\ProfilePhotoResource;
use App\Services\Storage\StorageService;
use Illuminate\Http\Request;

class ProfilePhotoController extends Controller
{
    private $storageService;

    public function __construct(StorageService $storageService)
    {
        $this->storageService = $storageService;
    }

    public function profileUpload( ProfilePhotoRequest $request){
        $user = auth()->user();
        $filePath = $this->storageService->store('public/uploads',$request->file('file_path','public'));
        // $filePath = '/storage'. $request->file('file_path')->store('/profile_photos', 'public');
        $name = $request->file('file_path')->getClientOriginalName();
        $user->name = $name;
        $user->file_path = $filePath;
        $user->save();

        return response()->json(
            [
                'status'     => 'success',
                'statusCode' => 201,
                'message'    => 'Profile photo uploaded successfully',
                'data'       => [
                    'profilePhoto' => new ProfilePhotoResource($user),
                ],
            ], 201
        );

    }
}
