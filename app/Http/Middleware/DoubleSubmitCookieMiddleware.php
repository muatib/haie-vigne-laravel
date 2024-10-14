<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;

class DoubleSubmitCookieMiddleware
{
    /**
     * Handle an incoming request.
     *
     * This middleware implements the Double Submit Cookie pattern for CSRF protection.
     * For GET requests, it generates a random CSRF token, stores it in the session, and attaches it as a cookie.
     * For POST requests, it validates the token by comparing the value from the cookie with the session token.
     * If validation fails, the request is aborted with a 403 error.
     *
     * @param  \Illuminate\Http\Request  $request  The current HTTP request.
     * @param  \Closure  $next  The next middleware or response to process.
     * @return mixed  The HTTP response, with CSRF token set as a cookie for GET requests.
     */
    public function handle($request, Closure $next)
    {
        // Log the start of CSRF token verification
        Log::info('DoubleSubmitCookie: Verification in progress');

        // For GET requests, generate a CSRF token, store it in the session, and set it as a cookie
        if ($request->isMethod('GET')) {
            // Generate a random token
            $token = Str::random(40);
            // Store the token in the session
            $request->session()->put('csrf_token', $token);
            // Proceed with the request and set the token as a secure cookie
            $response = $next($request);
            return $response->withCookie('csrf_token', $token, 120, null, null, false, true);
        }

        // For POST requests, validate the CSRF token by comparing the session and cookie tokens
        if ($request->isMethod('POST')) {
            // Retrieve the CSRF token from the cookie and session
            $cookieToken = $request->cookie('csrf_token');
            $sessionToken = $request->session()->get('csrf_token');

            // If either token is missing or they do not match, abort with a 403 error
            if (!$cookieToken || !$sessionToken || $cookieToken !== $sessionToken) {
                abort(403, 'CSRF validation failed');
            }
        }

        // Log successful CSRF token verification
        Log::info('DoubleSubmitCookie: Verification successful');

        // Allow the request to proceed if validation passes
        return $next($request);
    }
}
