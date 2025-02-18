<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckRecruiterMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Check if user is authenticated and has role_id == 3 (Recruiter)
        if (auth()->user() && auth()->user()->isRecruiter()) {
            return $next($request);
        }

        // Return error response if user is not a recruiter
        return response()->json([
            'status' => 'error',
            'message' => 'Access denied. Only recruiters are allowed.'
        ], 403);
    }
}
