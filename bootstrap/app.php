<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Http\Request;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__ . '/../routes/web.php',
        api: __DIR__ . '/../routes/api.php',
        commands: __DIR__ . '/../routes/console.php',
        health: '/up',
    )

    // ======================================================
    // 🛡️ MIDDLEWARE CONFIGURATION
    // ======================================================
    ->withMiddleware(function (Middleware $middleware) {

        // TRUST RAILWAY PROXY / HTTPS
        $middleware->trustProxies(
            at: '*',
            headers: Request::HEADER_X_FORWARDED_FOR |
                     Request::HEADER_X_FORWARDED_HOST |
                     Request::HEADER_X_FORWARDED_PORT |
                     Request::HEADER_X_FORWARDED_PROTO
        );

        // WEB MIDDLEWARE GROUP
        $middleware->web(append: [
            // Add web middlewares here if needed
        ]);

        // API MIDDLEWARE GROUP
        $middleware->api(append: [
            // Add api middlewares here if needed
        ]);

        // ALIASED MIDDLEWARE
        $middleware->alias([
            'auth'  => \App\Http\Middleware\Authenticate::class,
            'guest' => \App\Http\Middleware\RedirectIfAuthenticated::class,
            'role'  => \App\Http\Middleware\RoleMiddleware::class,
        ]);
    })

    // ======================================================
    // ⚠️ EXCEPTION HANDLING
    // ======================================================
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })

    ->create();