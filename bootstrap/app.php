<?php

use App\Exception\HttpException;
use App\Facades\ErrorFacade;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException as IlluminateValidationException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

return Application::configure(basePath: dirname(__DIR__))->withRouting(
        web: __DIR__ . '/../routes/web.php',
        commands: __DIR__ . '/../routes/console.php',
        health: '/up',
    )->withMiddleware(function (Middleware $middleware) {
        //
    })->withExceptions(function (Exceptions $exceptions) {
        $exceptions->render(function (Throwable $e, Request $request) use ($exceptions) {
            if ($e instanceof IlluminateValidationException) {
                return ErrorFacade::unprocessableEntity(
                    message: $e->getMessage(),
                    errors: $e->errors(),
                );
            }

            if ($e instanceof HttpException) {
                return ErrorFacade::customError(
                    statusCode: $e->getStatusCode(),
                    message: $e->getMessage(),
                    errors: $e->getErrors(),
                );
            }

            if ($e instanceof ModelNotFoundException || $e instanceof NotFoundHttpException) {
                return ErrorFacade::customError(
                    statusCode: $e->getStatusCode(),
                    message: __("No results found!"),
                    debug: [],
                );
            }
            return ErrorFacade::customError(
                statusCode: 500,
                message: $e->getMessage(),
                debug: $e->getTrace(),
            );
        });
    })->create();
