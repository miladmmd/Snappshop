<?php

namespace Modules\Notifications\Services;

use Illuminate\Database\Eloquent\Model;
use Modules\Notifications\Dtos\NotificationDto;
use Modules\Notifications\Dtos\NotificationRequestDto;
use Modules\Notifications\Dtos\SmsInfoDto;
use Modules\Notifications\Enums\DriverSmsProvidersEnum;
use Modules\Notifications\Enums\NotificationStatusEnum;
use Modules\Notifications\Facades\Providers\SmsProviderDetectorFacade;
use Modules\Notifications\Interfaces\Repositories\NotificationRepositoryInterfaces;
use Modules\Notifications\Interfaces\Repositories\ProviderRepositoryInterfaces;
use Modules\Notifications\Interfaces\Services\NotificationServiceInterface;
use Modules\Notifications\Interfaces\Services\SmsInfoServiceInterface;

class NotificationService implements NotificationServiceInterface
{
    public function __construct(
        private CreateNotificationService $createNotificationService,
        private NotificationRepositoryInterfaces $notificationRepository,
        private ProviderRepositoryInterfaces $providerRepository,
        private SmsInfoServiceInterface $smsInfoService
    ) {
    }

    public function createNotification(NotificationRequestDto $dto): void
    {
        $this->createNotificationService->handle($dto);
    }

    public function findNotification($id): Model
    {
        return $this->notificationRepository->findByIdOrFail($id);
    }

    public function sendSmsToProvider(NotificationDto $dto)
    {
        SmsProviderDetectorFacade::channel(
            driver: $this->detectorSmsProvider($dto->getProviderId())
        )->send($dto);
    }

    public function verifySms(SmsInfoDto $dto)
    {

        $notification = $this->notificationRepository->findByIdOrFail($dto->getNotificationId());
        $dto->setProviderId($notification->getAttribute('provider_id'));
        SmsProviderDetectorFacade::channel(
            driver: $this->detectorSmsProvider($dto->getProviderId())
        )->verify($dto);


    }

    protected function detectorSmsProvider($providerId)
    {
        $provider = $this->providerRepository->findByIdOrFail($providerId);
        $providerName = $provider->getAttribute('name');
        return match ($providerName) {
            config('settings.providers.kavenegar.name') => DriverSmsProvidersEnum::KAVENEGARCHANNEL_CLASS,
            config('settings.providers.ghasedak.name') => DriverSmsProvidersEnum::GHASEDAKCHANNEL_CLASS,
            default => throw new \Exception('wrong provider')
        };

    }


    public function update(int $id, NotificationStatusEnum $status): bool
    {
       return $this->notificationRepository->update($id,[
           'status' => $status
        ]);
    }

    public function decreaseCountTry($id): void
    {
        $countTry = $this->notificationRepository->findByIdOrFail($id)->getAttribute('count_try');
        if($countTry > 0) {
             $this->notificationRepository->update($id,[
               'count_try' => $countTry-1
            ]);
        }
    }
    public function failedNotification($id): void
    {
        $this->notificationRepository->update(modelId: $id,payload: [
            'status' => NotificationStatusEnum::FAILED
        ]);
        $notif = $this->notificationRepository->findByIdOrFail(modelId: $id,relations: ['smsInfos']);
        $ids = $notif->getRelation('smsInfos')->pluck('id')->toArray();
        dd($ids);
        $smsInfosId = $this->smsInfoService->batchFailedStatus($ids);


    }
}
