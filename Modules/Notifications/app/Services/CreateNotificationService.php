<?php

namespace Modules\Notifications\Services;

use Modules\Notifications\Dtos\NotificationRequestDto;
use Modules\Notifications\Enums\NotificationTypeEnum;
use Modules\Notifications\Helpers\DtoHelper;
use Modules\Notifications\Helpers\ReplaceTemplateHelper;
use Modules\Notifications\Interfaces\Repositories\NotificationRepositoryInterfaces;
use Modules\Notifications\Interfaces\Repositories\OperatorRepositoryInterfaces;
use Modules\Notifications\Interfaces\Repositories\ProviderOperatorRepositoryInterfaces;
use Modules\Notifications\Interfaces\Repositories\ServiceRepositoryInterfaces;
use Modules\Notifications\Interfaces\Repositories\TemplateRepositoryInterfaces;
use Modules\Notifications\Interfaces\Services\SendSmsServiceInterface;
use Modules\Notifications\Jobs\SendSmsToProviderJob;

class CreateNotificationService implements SendSmsServiceInterface
{
    protected int $notificationId;
    protected NotificationTypeEnum $type;
    public function __construct(
        private TemplateRepositoryInterfaces $templateRepository,
        private NotificationRepositoryInterfaces $notificationRepository,
        private ServiceRepositoryInterfaces $serviceRepository,
        private OperatorRepositoryInterfaces $operatorRepository,
        private ProviderOperatorRepositoryInterfaces $providerOperatorRepository
    )
    {
    }

    public function handle(NotificationRequestDto $dto): void
    {
        $this->createNotification($dto);
        $this->dispatchRelatedJob();
    }

    protected function createNotification(NotificationRequestDto $dto)
    {

      $serviceId =  $this->serviceRepository->findByApiKey($dto->getApiKey());
      $operatorId = $this->operatorRepository
          ->findOperatorByMobileNumber(mobile: $dto->getMobile(),columns: ['id'])
          ->getAttribute('id');
      $providerId = $this
          ->providerOperatorRepository
          ->findByOperator($operatorId)
          ->highestPriority()
          ->first(['provider_id'])
          ->getAttribute('provider_id');

      $templateId = $this
          ->templateRepository
          ->findByTopic($dto->getTemplateTopic())
          ->getAttribute('id');
        $notificationStoreDto = DtoHelper::createStoreNotificationDto(
            mobile: $dto->getMobile(),
            type: $dto->getTypeEnum(),
            argument:$dto->getArguments(),
            serviceId:$serviceId ,
            operatorId:$operatorId ,
            providerId:$providerId ,
            templateId:$templateId
        );
        $notification = $this
            ->notificationRepository
            ->create($notificationStoreDto->toArray());
        $this->notificationId = $notification->getAttribute('id');
        $this->type = $notification->getAttribute('type');

    }

    protected function dispatchRelatedJob()
    {
        if ($this->type == NotificationTypeEnum::SMS)
        {
            SendSmsToProviderJob::dispatch($this->notificationId);
        }
    }
    protected function createMessage(NotificationRequestDto $dto)
    {
       $topic =  $this
           ->templateRepository
           ->findByTopic($dto->getTemplateTopic())
           ->getAttribute('topic');
       $relatedTemplate = __('template')[$topic];
       throw_if(
           is_null($relatedTemplate),
           new \Exception("template don't exist")
       );
        $replacement = new ReplaceTemplateHelper(__('template')[$topic]);
        $message = $replacement($dto->getArguments());

    }


}
