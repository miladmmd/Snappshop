<?php

namespace Modules\Notifications\Jobs;

use App\JobHandler\QueuedJob;
use Exception;
use Illuminate\Support\Facades\DB;
use Modules\Notifications\Helpers\DtoHelper;
use Modules\Notifications\Interfaces\Services\NotificationServiceInterface;
use Modules\Notifications\Services\NotificationService;

class NotificationRequestJob extends QueuedJob
{
    public $tries = 1;

    protected $retryDelay = [

    ];

    /**
     * Create a new job instance.
     */
    public function __construct(protected array $array)
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(NotificationServiceInterface $notificationService): void
    {
        $payload = $this->array;
        $this->handleWithRetry(function () use ($payload,$notificationService) {
            $hasTopic = array_key_exists('template_topic', $payload);
            $hasMobile = array_key_exists('mobile', $payload);
            $hasEmail = array_key_exists('email', $payload);
            throw_if(
                condition: !$hasTopic,
                exception: new Exception(__('validation.topic_dont_exist'))
            );
            throw_if(
                condition: !$hasMobile && !$hasEmail,
                exception: new Exception(__('validation.mobile_email_dont_exist'))
            );
            $dto = DtoHelper::createNotificationRequestDto(
                templateTopic: $payload['template_topic'],
                type: $payload['type_enum'],
                arguments: $payload['arguments'],
                apiKey: $payload['api_key'],
                mobile: $payload['mobile']
            );
            $notificationService->createNotification($dto);
        });
    }
}
