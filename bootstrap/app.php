<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

use App\Http\Middleware\Authenticate;
use App\Http\Middleware\RedirectIfAuthenticated;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )

    ->withMiddleware(function (Middleware $middleware) {

        // Beritahu Laravel untuk mempercayai semua proxy
        // termasuk Railway dan Ngrok
        $middleware->trustProxies(at: '*');

        // Webhook Midtrans tidak mengirim CSRF token
        $middleware->validateCsrfTokens(except: [
            'midtrans/notification',
        ]);

        // Jika nanti ingin menggunakan custom middleware:
        // $middleware->alias([
        //     'auth'  => Authenticate::class,
        //     'guest' => RedirectIfAuthenticated::class,
        // ]);
    })

    ->withExceptions(function (Exceptions $exceptions) {
        //
    })

    ->create();