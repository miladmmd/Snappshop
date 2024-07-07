<?php

namespace App\Exception;

use Symfony\Component\HttpKernel\Exception\HttpException as BaseHttpException;
class HttpException extends BaseHttpException
{
    private array $errors;

    public function __construct(
        int $statusCode,
        string $message = '',
        array $errors = [],
        \Throwable $previous = null,
        array $headers = [],
        int $code = 0
    ) {
        $this->errors = $errors;

        parent::__construct(
            statusCode: $statusCode,
            message: $message,
            previous: $previous,
            headers: $headers,
            code: $code
        );
    }

    public function getErrors()
    {
        return $this->errors;
    }
}
