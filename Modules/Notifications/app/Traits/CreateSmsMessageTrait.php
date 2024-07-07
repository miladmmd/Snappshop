<?php

namespace Modules\Notifications\Traits;

use Modules\Notifications\Dtos\NotificationDto;
use Modules\Notifications\Helpers\ReplaceTemplateHelper;

trait CreateSmsMessageTrait
{
    public function createMessage(NotificationDto $notificationDto)
    {
        $topic = $this->templateRepository->findByIdOrFail(
            modelId: $notificationDto->getTemplateId(), columns: ['topic']
        )->getAttribute('topic');

        $relatedTemplate = __('template')[$topic];
        throw_if(
            is_null($relatedTemplate),
            new Exception("template don't exist")
        );
        $replacement = new ReplaceTemplateHelper(__('template')[$topic]);
        return $replacement(json_decode($notificationDto->getArgument(), true));
    }
}
