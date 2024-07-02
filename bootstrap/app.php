<?php

use App\Http\Middleware\Admin;
use App\Http\Middleware\EtablissementMiddleware;
use App\Http\Middleware\RedirectIfAuthenticatedAdmin;
// use App\Models\Etablissement;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__ . '/../routes/web.php',
        commands: __DIR__ . '/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->alias([
            'admin' => Admin::class,
            'etablissement' => EtablissementMiddleware::class,
            'adminguest' => RedirectIfAuthenticatedAdmin::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
