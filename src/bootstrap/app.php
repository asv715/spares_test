<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Http\Request;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        api: __DIR__.'/../routes/api.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
        apiPrefix: 'api/v1',
    )
    ->withMiddleware(function (Middleware $middleware) {
        //
    })
    ->withExceptions(function (Exceptions $exceptions) {
        $exceptions->render(function (\App\Exceptions\OverallException $e, Request $request) {
            return response()->json([
                'message' => $e->getMessage(),
                'code' => $e->getCode()
            ], 422);
        })->dontReport(\App\Exceptions\OverallException::class);

        $exceptions->render(function (\App\Exceptions\ProductCountMismatchException $e, Request $request) {
            return response()->json([
                'message' => $e->getMessage(),
                'code' => $e->getCode()
            ], 422);
        });

        $exceptions->render(function (\App\Exceptions\NotEnoughOnStockException $e, Request $request) {
            return response()->json([
                'message' => $e->getMessage(),
                'code' => $e->getCode()
            ], 422);
        });

        $exceptions->render(function (\App\Exceptions\IncorrectStatusChangeException $e, Request $request) {
            return response()->json([
                'message' => $e->getMessage(),
                'code' => $e->getCode()
            ], 422);
        });
    })->create();
