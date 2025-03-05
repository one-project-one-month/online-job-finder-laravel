<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Http\Exceptions\PostTooLargeException;
use Illuminate\Http\Request;
use Laravel\Passport\Exceptions\AuthenticationException;
use Spatie\Permission\Exceptions\UnauthorizedException;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Throwable;

class Handler extends ExceptionHandler
{
    /
     * A list of exception types with their corresponding custom log levels.
     *
     * @var array<class-string<\Throwable>, \Psr\Log\LogLevel::*>
     */
    protected $levels = [
        //
    ];

    /
     * A list of the exception types that are not reported.
     *
     * @var array<int, class-string<\Throwable>>
     */
    protected $dontReport = [
        //
    ];

    /
     * A list of the inputs that are never flashed to the session on validation exceptions.
     *
     * @var array<int, string>
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    /
     * Register the exception handling callbacks for the application.
     *
     * @return void
     */
    public function register()
    {
        // $this->reportable(function (Throwable $e) {
        //     //
        // });

        $this->reportable(function (\League\OAuth2\Server\Exception\OAuthServerException $e) {
            if ($e->getCode() == 9) {
                return false;
            }

        });

        $this->renderable(function (Exception $e, Request $request) {
            if ($request->is('api/*')) {
                if ($e instanceof \League\OAuth2\Server\Exception\OAuthServerException) {
                    return response()->json([
                        'status'  => false,
                        'message' => 'Session expired',
                    ], 419);
                }

                if ($e instanceof PostTooLargeException) {
                    return response()->json([
                        'status'  => false,
                        'message' => 'File is too big or invalid',
                    ], 422);
                }
                if ($e instanceof NotFoundHttpException) {
                    return response()->json([
                        'status'  => false,
                        'message' => 'Not Found',
                    ], 404);
                }
                if ($e instanceof AuthenticationException) {
                    return response()->json([
                        'status'  => false,
                        'message' => 'Unauthenticated',
                    ], 401);
                }

                if ($e instanceof UnauthorizedException) {
                    return response()->json([
                        'status'  => false,
                        'message' => 'Unauthorized',
                    ], 401);
                }

                if ($e instanceof CustomException) {
                    return response()->json([
                        "code"    => $e->getCustomCode(),
                        'message' => "Something Went Wrong!",
                    ], $e->getCode());
                }
            }
        });

        $this->renderable(function (AccessDeniedHttpException $e, $request) {
            if ($request->is('api/*')) {
                return response()->json([
                    "status"  => false,
                    'message' => 'Unauthorized.',
                ], 403);
            }
        });
    }
}
