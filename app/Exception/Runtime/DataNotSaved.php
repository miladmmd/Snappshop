<?php

namespace App\Exception\Runtime;

class DataNotSaved extends \RuntimeException
{
    public function __construct()
    {
        parent::__construct(message: 'Data not saved!');
    }
}
