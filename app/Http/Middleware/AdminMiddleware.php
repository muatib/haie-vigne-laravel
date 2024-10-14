<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * This method checks if the current authenticated user has admin privileges.
     * If the user is not authenticated or is not an admin, the request is aborted
     * with a 403 (Access Denied) response. Otherwise, the request proceeds to the next middleware.
     *
     * @param  \Illuminate\Http\Request  $request  The current HTTP request.
     * @param  \Closure  $next  The next middleware or response to process.
     * @return mixed  The HTTP response, or a termination if the user lacks admin privileges.
     */
    public function handle(Request $request, Closure $next)
    {
        // Check if the user is not authenticated or is not an admin
        if (!Auth::check() || !Auth::user()->is_admin) {
            // Abort the request with a 403 error and a custom message
            abort(403, 'Unauthorized access.');
        }

        // If the user is an admin, proceed to the next middleware or controller
        return $next($request);
    }
}
