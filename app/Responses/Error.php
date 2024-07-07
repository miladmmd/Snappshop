<?php

namespace App\Responses;

use App\Trait\ResponseParser;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class Error
{
    use ResponseParser;
    public function badRequest(
        array|string $message = null,
        array|string $errors = [],
        ?array $debug = null
    ): JsonResponse {
        return $this->standardResp(
            statusCode: Response::HTTP_BAD_REQUEST,
            message: $message,
            data: $errors,
            debug: $debug
        );
    }

    public function notFound(
        array|string $message = null,
        array|string $errors = [],
        ?array $debug = null
    ): JsonResponse {
        return $this->standardResp(
            statusCode: Response::HTTP_NOT_FOUND,
            message: $message,
            data: $errors,
            debug: $debug
        );
    }

    public function unauthorized(
        array|string $message = null,
        array|string $errors = [],
        ?array $debug = null
    ): JsonResponse {
        return $this->standardResp(
            statusCode: Response::HTTP_UNAUTHORIZED,
            message: $message,
            data: $errors,
            debug: $debug
        );
    }

    public function unprocessableEntity(
        array|string $message = null,
        array|string $errors = [],
        ?array $debug = null
    ): JsonResponse {
        return $this->standardResp(
            statusCode: Response::HTTP_UNPROCESSABLE_ENTITY,
            message: $message,
            data: $errors,
            debug: $debug
        );
    }

    public function serverError(
        array|string $message = null,
        array|string $errors = [],
        ?array $debug = null
    ): JsonResponse {
        return $this->standardResp(
            statusCode: Response::HTTP_INTERNAL_SERVER_ERROR,
            message: $message,
            data: $errors,
            debug: $debug
        );
    }

    public function customError(
        int $statusCode,
        array|string $message = null,
        array|string $errors = [],
        ?array $debug = null
    ): JsonResponse {
        return $this->standardResp(
            statusCode: $statusCode,
            message: $message,
            data: $errors,
            debug: $debug
        );
    }
}
