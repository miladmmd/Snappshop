<?php

namespace Modules\Notifications\Interfaces\Services;

use Modules\Notifications\Dtos\NotificationDto;
use Modules\Notifications\Dtos\SmsInfoDto;

interface SmsProviderChannelInterface
{
    public function send(NotificationDto $notificationDto): void;

    public function verify(SmsInfoDto $smsInfoDto);
}
