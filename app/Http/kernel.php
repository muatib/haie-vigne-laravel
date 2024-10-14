<?php

namespace App\Http;

use Illuminate\Foundation\Http\Kernel as HttpKernel;

class Kernel extends HttpKernel
{
    // ...

    /**
     * The application's route middleware.
     *
     * These middleware may be assigned to groups or used individually.
     *
     * @var array
     */
    protected $routeMiddleware = [

        'admin' => \App\Http\Middleware\AdminMiddleware::class,
        'custom.csrf' => \App\Http\Middleware\CustomCsrfMiddleware::class,
        'check.referer' => \App\Http\Middleware\CheckReferer::class,
        'double.submit.cookie' => \App\Http\Middleware\DoubleSubmitCookieMiddleware::class,
    ];


}
