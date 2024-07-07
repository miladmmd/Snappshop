<?php

namespace Modules\Notifications\Services\Providers\Sms\Channels;

use Exception;
use Kavenegar;
use Modules\Notifications\Dtos\NotificationDto;
use Modules\Notifications\Dtos\SmsInfoDto;
use Modules\Notifications\Enums\KavenegarVerifiedStatusEnum;
use Modules\Notifications\Enums\NotificationStatusEnum;
use Modules\Notifications\Helpers\ReplaceTemplateHelper;
use Modules\Notifications\Interfaces\Repositories\TemplateRepositoryInterfaces;
use Modules\Notifications\Interfaces\Services\NotificationServiceInterface;
use Modules\Notifications\Interfaces\Services\SmsInfoServiceInterface;
use Modules\Notifications\Interfaces\Services\SmsProviderChannelInterface;
use Modules\Notifications\Jobs\SendSmsToProviderJob;
use Modules\Notifications\Jobs\VerifySmsJob;
use Modules\Notifications\Traits\CreateSmsMessageTrait;

class KavenegarChannel implements SmsProviderChannelInterface
{
    use CreateSmsMessageTrait;
    public function __construct(
        protected TemplateRepositoryInterfaces $templateRepository,
        protected SmsInfoServiceInterface $smsInfoService,
        protected NotificationServiceInterface $notificationService
    ) {
    }

    public function send(NotificationDto $notificationDto): void
    {
            $message = $this->createMessage($notificationDto);
            $receptor = array($notificationDto->getMobile());
            $result = Kavenegar::Send(
                config('settings.providers.kavenegar.sender'),
                $notificationDto->getMobile(),
                $message
            );
            $dto = new SmsInfoDto();
            $dto->setStatus($result[0]->status);
            $dto->setSender($result[0]->sender);
            $dto->setMessageId($result[0]->messageid);
            $dto->setNotificationId($notificationDto->getId());
            $smsInfo = $this->smsInfoService->create($dto);
            $this->notificationService->update($notificationDto->getId(), NotificationStatusEnum::SEND);
            VerifySmsJob::dispatch($smsInfo->getAttribute('id'))->delay(now()->addSecond(5));
    }


    public function verify(SmsInfoDto $smsInfoDto)
    {
        $result = Kavenegar::status($smsInfoDto->getMessageId());
        if ($result[0]->status == KavenegarVerifiedStatusEnum::DELIVERED->value) {
            $this->smsInfoService->updateStatus($smsInfoDto->getId(), KavenegarVerifiedStatusEnum::DELIVERED->value);
            $this->notificationService->update($smsInfoDto->getNotificationId(), NotificationStatusEnum::VERIFY);
        }

        if (in_array($result[0]->status, KavenegarVerifiedStatusEnum::getWillRetryVerifyStatus())) {
            VerifySmsJob::dispatch($smsInfoDto->getId())->delay(now()->addMinute(2));
        }
        if (in_array($result[0]->status, KavenegarVerifiedStatusEnum::getWillRetrySendSms())) {
            SendSmsToProviderJob::dispatch($smsInfoDto->getNotificationId());
        }
    }
}
