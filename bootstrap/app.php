<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__ . '/../routes/web.php',
        api: __DIR__ . '/../routes/api.php',
        commands: __DIR__ . '/../routes/console.php',
        health: '/up',
    )

    // ======================================================
    // 🛡️ MIDDLEWARE CONFIGURATION (REPLACES Kernel.php)
    // ======================================================
    ->withMiddleware(function (Middleware $middleware) {

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
