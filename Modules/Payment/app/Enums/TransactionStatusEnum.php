<?php

namespace Modules\Payment\Enums;

enum TransactionStatusEnum: int
{
    case FAILED = 1;
    case SUCCESS = 2;

    case pending = 3;
}
