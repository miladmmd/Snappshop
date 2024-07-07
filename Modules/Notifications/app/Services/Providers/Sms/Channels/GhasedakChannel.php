<?php

namespace Modules\Notifications\Services\Providers\Sms\Channels;

use Ghasedak\Laravel\GhasedakFacade;
use Modules\Notifications\Dtos\NotificationDto;
use Modules\Notifications\Dtos\SmsInfoDto;
use Modules\Notifications\Interfaces\Services\SmsProviderChannelInterface;
use Modules\Notifications\Traits\CreateSmsMessageTrait;

class GhasedakChannel implements SmsProviderChannelInterface
{
    use CreateSmsMessageTrait;

    public function send(NotificationDto $notificationDto): void
    {
        $message = $this->createMessage($notificationDto);
        $response = GhasedakFacade::SendSimple($notificationDto->getMobile(), $message, config('settings.providers.ghasedak.sender') , $sendDate = null, $checkId = null);
    }

    public function verify(SmsInfoDto $smsInfoDto)
    {
        // TODO: Implement verify() method.
    }
}
