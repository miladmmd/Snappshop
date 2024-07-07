<?php

namespace Modules\Payment\Interfaces\UseModules;

interface NotificationModuleInterface
{
    public function sendNotificationDeposit(int $mobile,array $argument): void;

    public function sendNotificationRecipient(int $mobile,array $argument): void;
}
