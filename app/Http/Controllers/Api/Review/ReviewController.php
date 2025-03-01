<?php
namespace App\Http\Controllers\Api\Review;

use App\Http\Controllers\Controller;
use App\Http\Middleware\MustBeApplicant;
use App\Http\Requests\Review\ReviewRequest;
use App\Http\Resources\Review\ReviewResource;
use App\Models\Review\Review;
use App\Services\Review\ReviewService;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Support\Facades\Gate;

class ReviewController extends Controller implements HasMiddleware
{
    protected $reviewService;

    public function __construct(ReviewService $reviewService)
    {
        $this->reviewService = $reviewService;
    }

    public static function middleware(): array
    {
        return [
            new Middleware(middleware: MustBeApplicant::class, except: ['index', 'show']),
        ];
    }

    public function index(Request $request)
    {
        try {
            $reviews = $this->reviewService->getAllReviews($request);

            return response()->json([
                'message'    => 'review fetching successful',
                'statusCode' => 200,
                'status'     => 'success',
                'data'       => [
                    'reviews' => ReviewResource::collection($reviews),
                ],
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'message'    => $e->getMessage(),
                'statusCode' => 500,
                'status'     => 'error',

            ], 500);
        }
    }

    public function store(ReviewRequest $request)
    {
        try {
            $createdReview = $this->reviewService->createReview($request->toArray());
            $review        = $this->reviewService->showReviewById($createdReview->id);

            return response()->json([
                'message'    => 'review created successfully',
                'statusCode' => 201,
                'status'     => 'success',
                'data'       => [
                    'review' => new ReviewResource($review),
                ],
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'message'    => $e->getMessage(),
                'statusCode' => 500,
                'status'     => 'error',
            ], 500);
        }
    }

    public function show($id)
    {
        try {
            $review = $this->reviewService->showReviewById($id);
            return response()->json([
                'message'    => 'review fetched successfully',
                'statusCode' => 200,
                'status'     => 'success',
                'data'       => [
                    'review' => new ReviewResource($review),
                ],
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'message'    => $e->getMessage(),
                'statusCode' => 500,
                'status'     => 'error',
            ], 500);
        }
    }

    public function update(ReviewRequest $request, $company_id, $review_id)
    {
        $review = Review::findOrFail($review_id);
        Gate::authorize('update', $review);

        try {
            $this->reviewService->updateReview($request->toArray(), $review_id);
            $review = $this->reviewService->showReviewById($review_id);

            return response()->json([
                'message'    => 'review updated successfully',
                'statusCode' => 200,
                'status'     => 'success',
                'data'       => [
                    'review' => new ReviewResource($review),
                ],
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'message'    => $e->getMessage(),
                'statusCode' => 500,
                'status'     => 'error',
            ], 500);
        }
    }

    public function destroy($company_id, $review_id)
    {
        $review = Review::findOrFail($review_id);
        Gate::authorize('delete', $review);

        try {
            $review->delete();

            return response()->json([], 204);
        } catch (\Exception $e) {
            return response()->json([
                'message'    => $e->getMessage(),
                'statusCode' => 500,
                'status'     => 'error',
            ], 500);
        }
    }

}
