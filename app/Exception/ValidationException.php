<?php

namespace App\Exception;

class ValidationException extends \Exception
{
    public function __construct(private \Illuminate\Support\MessageBag $invalid)
    {
        parent::__construct(message: __('validation.general_exception'), code: 0, previous: null);
    }

    public function getErrors(): array
    {
        return $this->invalid->toArray();
    }

}