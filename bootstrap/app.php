<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\SetLocale;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
        using: function () {

            $configureRoute = function (
                $prefix,
                $name,
                $path,
                $middleware = ['web', SetLocale::class]
            ) {
                Route::middleware($middleware)
                    ->prefix($prefix)
                    ->name($name)
                    ->group(base_path($path));
            };

            // Public web
            Route::middleware(['web', SetLocale::class])->group(base_path('routes/web.php'));

            // =======================
            // Admin
            // =======================

            // Auth (none auth middleware)
            $configureRoute('dashboard/admin','dashboard.admin.auth.','routes/dashboard/admin/auth.php',['web', SetLocale::class]);

            // Protected
            $configureRoute('dashboard/admin','dashboard.admin.','routes/dashboard/admin/web.php', ['web', 'auth:admin', SetLocale::class]);
            $configureRoute('dashboard/admin/managements','dashboard.admin.managements.','routes/dashboard/admin/management.php',['web', 'auth:admin', SetLocale::class]);
            $configureRoute('dashboard/admin/evaluations','dashboard.admin.evaluations.','routes/dashboard/admin/evaluation.php',['web', 'auth:admin', SetLocale::class]);
            $configureRoute('dashboard/admin/categories','dashboard.admin.categories.','routes/dashboard/admin/category.php',['web', 'auth:admin', SetLocale::class]);
            $configureRoute('dashboard/admin/institutions','dashboard.admin.institutions.','routes/dashboard/admin/institution.php',['web', 'auth:admin', SetLocale::class]);

            // =======================
            // Organization
            // =======================

            // Auth (none auth middleware)
            $configureRoute('dashboard/organization','dashboard.organization.auth.','routes/dashboard/organization/auth.php',['web', SetLocale::class]);
            // Protected web.php
            $configureRoute('dashboard/organization','dashboard.organization.','routes/dashboard/organization/web.php',['web', 'auth:organization', SetLocale::class]);

        },
    )->withMiddleware(function (Middleware $middleware): void {

        $middleware->append([
            \App\Http\Middleware\SetLocale::class,
        ]);

        $middleware->redirectGuestsTo(function ($request) {

            $route = $request->route();

            if (!$route) return null;

            $middlewares = $route->gatherMiddleware();

            if (collect($middlewares)->contains(fn ($m) => str_contains($m, 'auth:admin'))) {
                return route('dashboard.admin.auth.login.index');
            }

            if (collect($middlewares)->contains(fn ($m) => str_contains($m, 'auth:organization'))) {
                return route('dashboard.organization.auth.login.index');
            }

            return null;
        });
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        //
    })->create();
