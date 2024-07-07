<?php

namespace Modules\Payment\Exceptions;

use App\Exception\HttpException;
use Exception;
use Symfony\Component\HttpFoundation\Response;

class P2pException extends HttpException
{
    public function __construct($message)
    {
        parent::__construct(
            statusCode: Response::HTTP_FORBIDDEN,
            message: $message
        );
    }
}
