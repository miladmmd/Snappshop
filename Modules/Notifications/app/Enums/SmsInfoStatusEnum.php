<?php

namespace Modules\Notifications\Enums;

enum SmsInfoStatusEnum: int
{
    case FAILED = 6;
    case DELIVERED = 10;
}
