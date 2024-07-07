<?php

namespace Modules\Notifications\Jobs;

use App\JobHandler\QueuedJob;
use Modules\Notifications\Dtos\SmsInfoDto;
use Modules\Notifications\Interfaces\Services\NotificationServiceInterface;
use Modules\Notifications\Interfaces\Services\SmsInfoServiceInterface;

class VerifySmsJob extends QueuedJob
{
    public $tries =1;

    protected $retryDelay = [];

    public function __construct(protected int $smsInfoId)
    {
        //
    }

    public function handle(
        NotificationServiceInterface $notificationService,
        SmsInfoServiceInterface $smsInfoService
    ): void
    {
        $smsInfoId = $this->smsInfoId;
        $this->handleWithRetry(function () use ($smsInfoId,$notificationService,$smsInfoService) {
            $smsInfo = $smsInfoService->find($smsInfoId);
            $dto = new SmsInfoDto();
            $dto->setNotificationId($smsInfo->getAttribute('notification_id'));
            $dto->setSender($smsInfo->getAttribute('sender'));
            $dto->setStatus($smsInfo->getAttribute('status'));
            $dto->setMessageId($smsInfo->getAttribute('message_id'));
            $dto->setId($smsInfo->getAttribute('id'));
            $notificationService->verifySms($dto);

        });
    }
}
