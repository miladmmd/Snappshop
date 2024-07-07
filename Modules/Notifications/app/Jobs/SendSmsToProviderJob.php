<?php

namespace Modules\Notifications\Jobs;

use App\JobHandler\QueuedJob;
use Exception;
use Illuminate\Support\Facades\DB;
use Modules\Notifications\Helpers\DtoHelper;
use Modules\Notifications\Interfaces\Services\NotificationServiceInterface;

class SendSmsToProviderJob extends QueuedJob
{
    public $tries = 1;

    protected $retryDelay = [];

    public function __construct(protected int $notificationId)
    {
    }

    /**
     * Execute the job.
     */
    public function handle(NotificationServiceInterface $notificationService): void
    {
        $notificationId = $this->notificationId;
        $this->handleWithRetry(function () use ($notificationId, $notificationService) {
            DB::beginTransaction();
            try {
                $notification = $notificationService->findNotification($notificationId);
                $notificationDto = DtoHelper::createNotificationDto(
                    mobile: $notification->getAttribute('mobile'),
                    type: $notification->getAttribute('type'),
                    argument: json_decode($notification->getAttribute('argument'), true),
                    serviceId: $notification->getAttribute('service_id'),
                    operatorId: $notification->getAttribute('operator_id'),
                    providerId: $notification->getAttribute('provider_id'),
                    templateId: $notification->getAttribute('template_id'),
                    id: $notification->getAttribute('id'),
                    notificationStatusEnum: $notification->getAttribute('status')
                );
                $notificationService->sendSmsToProvider($notificationDto);
                DB::commit();
            } catch (Exception $e) {
                DB::rollBack();
                DB::transaction(function () use ($notificationService, $notificationId) {
                    if ($this->job->attempts() == $this->job->maxTries()) {
                        $notification = $notificationService->findNotification($notificationId);
                        if ($notification->getAttribute('count_try') > 0) {
                            dump($notification->getAttribute('count_try'));
                            $notificationService->decreaseCountTry($notificationId);
                            SendSmsToProviderJob::dispatch($notificationId);
                        } elseif ($notification->getAttribute('count_try') == 0) {;
                            $notificationService->failedNotification($notificationId);
                        }
                    }
                });
            }
        });
    }
}
