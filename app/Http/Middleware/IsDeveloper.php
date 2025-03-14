<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Auth;

class IsDeveloper
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $developer_mails = explode(',', Config::get('developer.developer_mails'));

        if (Auth::check() &&  in_array(Auth::user()->email, $developer_mails)) {
            return $next($request);
        }

        return redirect('dashboard')->with('error', 'You have not developer access');
    }
}
