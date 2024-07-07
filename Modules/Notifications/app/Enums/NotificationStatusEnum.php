<?php

namespace Modules\Notifications\Enums;

enum NotificationStatusEnum: int
{
    case PENDING = 1;
    case SEND = 2;
    case VERIFY = 3;
    case FAILED = 4;
}
