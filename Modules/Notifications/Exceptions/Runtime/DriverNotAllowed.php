<?php

use RuntimeException;

class DriverNotAllowed extends RuntimeException
{
    public function __construct()
    {
        return parent::__construct(
            message: 'You can not use this driver!'
        );
    }
}
