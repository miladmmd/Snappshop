<?php

namespace Modules\Payment\Enums;

enum TransactionTypeEnum: int
{
    case DEBIT = 1;
    case CREDIT = 2;
    case DEBIT_CORRECTION = 3;
    case CREDIT_CORRECTION = 4;

}
