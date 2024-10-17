<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\StreamedResponse;

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
        Log::info('DoubleSubmitCookie: Verification in progress');

        if ($request->isMethod('GET')) {
            $token = Str::random(40);
            $request->session()->put('csrf_token', $token);
            $response = $next($request);

            // Check if the response is not a StreamedResponse before adding the cookie
            if (!($response instanceof StreamedResponse)) {
                $response->withCookie('csrf_token', $token, 120, null, null, false, true);
            }

            return $response;
        }

        if ($request->isMethod('POST')) {
            $cookieToken = $request->cookie('csrf_token');
            $sessionToken = $request->session()->get('csrf_token');

            if (!$cookieToken || !$sessionToken || $cookieToken !== $sessionToken) {
                abort(403, 'CSRF validation failed');
            }
        }


        return $next($request);
    }
}
