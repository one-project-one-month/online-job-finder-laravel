<?php
namespace App\Http\Controllers\SocialMedia;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use App\Models\SocialMedia\SocialMedia;
use App\Http\Requests\SocialMediaRequest;
use App\Http\Resources\SocialMediaResource;
use App\Services\SocialMedia\SocialMediaService;

class SocialMediaController extends Controller
{
    protected $socialMedia;

    public function __construct(SocialMediaService $socialMedia)
    {
        $this->socialMedia = $socialMedia;
    }

    public function index(Request $request)
    {
        try {
            $user = Auth::user();

            $request->merge([
                'user_id' => $user->id,
            ]);

            $socialMedia = $this->socialMedia->getAllSocialMedia($request);

            return response()->json([
                'message'    => 'social media created successfully',
                'status'     => 'success',
                'statusCode' => 200,
                'data'       => [
                    'socialMedias' => SocialMediaResource::collection($socialMedia),
                ],
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'message'    => $e->getMessage(),
                'status'     => 'fail',
                'statusCode' => 500,
            ], 500);
        }
    }

    public function store(SocialMediaRequest $request)
    {

        try {
            $user = Auth::user();

            $request->merge([
                'user_id' => $user->id,
            ]);

            $socialMedia = $this->socialMedia->createSocialMedia($request->toArray());

            return response()->json([
                'message'    => 'social media created successfully',
                'status'     => 'success',
                'statusCode' => 201,
                'data'       => [
                    'socialMedias' => SocialMediaResource::make($socialMedia),
                ],
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'message'    => $e->getMessage(),
                'status'     => 'error',
                'statusCode' => 500,
            ], 500);
        }

    }

    public function show($id)
    {

        try {
            $socialMedia = $this->socialMedia->getSocialMediaById($id);

            return response()->json([
                'message'    => 'social media fetched successfully',
                'status'     => 'success',
                'statusCode' => 200,
                'data'       => [
                    'socialMedias' => SocialMediaResource::make($socialMedia),
                ],
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'message'    => $e->getMessage(),
                'status'     => 'error',
                'statusCode' => 500,
            ], 500);
        }

    }

    public function update(SocialMediaRequest $request, $id)
    {
        try {
            if (Gate::denies('update', $id)) {
                return response()->json([
                    'message'    => 'Unauthorized action',
                    'status'     => 'error',
                    'statusCode' => 403,
                ], 403);
            }
            $updateSocialMedia = $this->socialMedia->updateSocialMedia($request->toArray(), $id);

            return response()->json([
                'message'    => 'Social Media Update successfully',
                'status'     => 'success',
                'statusCode' => 200,
                'data'       => [
                    'socialMedia' => SocialMediaResource::make($updateSocialMedia),
                ],
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'message'    => $e->getMessage(),
                'status'     => 'error',
                'statusCode' => 500,
            ], 500);
        }

    }

    public function destroy($id)
    {
        if (Gate::denies('delete', $id)) {
            return response()->json([
                'message'    => 'Unauthorized action',
                'status'     => 'error',
                'statusCode' => 403,
            ], 403);
        }
        $this->socialMedia->deleteSocialMedia($id);
        return response()->json([
            'message'    => 'social media deleted successfully',
            'status'     => 'success',
            'statusCode' => 200,
        ], 200);
    }
}
