<?php

namespace App\Facades;

use App\Responses\Error;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Facade;

/**
 * @method static JsonResponse badRequest(array|string $message = null, array|string $errors = [], ?array $debug = [])
 * @method static JsonResponse notFound(array|string $message = null, array|string $errors = [], ?array $debug = [])
 * @method static JsonResponse unauthorized(array|string $message = null, array|string $errors = [], ?array $debug = [])
 * @method static JsonResponse unprocessableEntity(array|string $message = null, array|string $errors = [], ?array $debug = [])
 * @method static JsonResponse serverError(array|string $message = null, array|string $errors = [], ?array $debug = [])
 * @method static JsonResponse customError(int $statusCode, array|string $message = null, array|string $errors = [], ?array $debug = [])
 */
class ErrorFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        $class = Error::class;
        static::clearResolvedInstance($class);
        return $class;
    }

}
