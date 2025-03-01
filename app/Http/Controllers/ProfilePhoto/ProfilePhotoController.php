<?php

namespace App\Http\Controllers\ProfilePhoto;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProfilePhoto\ProfilePhotoRequest;
use App\Http\Resources\ProfilePhotoResource;
use Illuminate\Http\Request;

class ProfilePhotoController extends Controller
{
    public function profileUpload( ProfilePhotoRequest $request){
        $user=auth()->user();
        $filePath = '/storage/'. $request->file('profile_photo')->store('profile_photos', 'public');
        $user->profile_photo = $filePath;
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
