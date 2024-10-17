<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;

class CheckReferer
{
    /**
     * Handle an incoming request.
     *
     * This method checks the 'referer' HTTP header to ensure that it matches
     * the current host. If the referer is absent or matches the host, the request
     * is allowed to proceed. Otherwise, it is blocked with a 403 error.
     *
     * @param  \Illuminate\Http\Request  $request  The current HTTP request.
     * @param  \Closure  $next  The next middleware to execute.
     * @return mixed  The HTTP response, or a termination/abort if the check fails.
     */
    public function handle(Request $request, Closure $next)
    {


        // Get the referer from the HTTP headers
        $referer = $request->headers->get('referer');
        // Get the current request's host
        $host = $request->getHost();



        // If the referer is absent or contains the host, allow the request to continue
        if (!$referer || Str::contains($referer, $host)) {
            return $next($request);
        }


        // Abort the request with a 403 error (Access Denied)
        abort(403, 'Invalid referer');



        // Proceed to the next middleware or HTTP response
        return $next($request);
    }
}
