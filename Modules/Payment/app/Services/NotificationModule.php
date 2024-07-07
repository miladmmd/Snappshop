<?php

namespace Modules\Payment\Services;


use Modules\Notifications\Enums\NotificationTypeEnum;
use Modules\Notifications\Helpers\DtoHelper;
use Modules\Notifications\Jobs\NotificationRequestJob;
use Modules\Payment\Interfaces\UseModules\NotificationModuleInterface;

class NotificationModule implements NotificationModuleInterface
{

    public function sendNotificationDeposit(int $mobile, array $argument): void
    {


        $notificationRequestDto = DtoHelper::createNotificationRequestDto(
            templateTopic: config('templates.paymentTemplates.deposit.name'),
            type: NotificationTypeEnum::SMS,
            arguments: $argument,
            apiKey: env('PAYMENT_SERVICE_API_KEY'),
            mobile: $mobile
        );

        NotificationRequestJob::dispatch($notificationRequestDto->toArray());
    }

    public function sendNotificationRecipient(int $mobile, array $argument): void
    {
        $notificationRequestDto = DtoHelper::createNotificationRequestDto(
            templateTopic: config('templates.paymentTemplates.withdraw.name'),
            type: NotificationTypeEnum::SMS,
            arguments: $argument,
            apiKey: env('PAYMENT_SERVICE_API_KEY'),
            mobile: $mobile
        );
        NotificationRequestJob::dispatch($notificationRequestDto->toArray());
    }
}
