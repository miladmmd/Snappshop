<?php

namespace Modules\Notifications\Interfaces\Services;

use Modules\Notifications\Dtos\NotificationRequestDto;

interface SendSmsServiceInterface
{
    public function handle(NotificationRequestDto $dto): void;
}
