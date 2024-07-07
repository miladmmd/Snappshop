<?php

namespace Modules\Payment\Enums;

enum CreditCardStatusEnum: int
{
    case WAITING = 1;
    case ACTIVE = 2;
    case INACTIVE= 3;
}
