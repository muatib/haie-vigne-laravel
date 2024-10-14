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
        // Log information to indicate that referer checking has started
        Log::info('CheckReferer: Checking in progress');

        // Get the referer from the HTTP headers
        $referer = $request->headers->get('referer');
        // Get the current request's host
        $host = $request->getHost();

        // Log the referer and host for debugging purposes
        Log::info('Referer: ' . $referer);
        Log::info('Host: ' . $host);

        // If the referer is absent or contains the host, allow the request to continue
        if (!$referer || Str::contains($referer, $host)) {
            return $next($request);
        }

        // If the referer is invalid, log a warning message
        Log::warning('Invalid referer: ' . $referer);
        // Abort the request with a 403 error (Access Denied)
        abort(403, 'Invalid referer');

        // This part will never be reached because abort() halts execution
        Log::info('Referer check passed successfully');
        Log::info('CheckReferer: Verification successful');

        // Proceed to the next middleware or HTTP response
        return $next($request);
    }
}
