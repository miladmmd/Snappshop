<?php

namespace Modules\Notifications\Interfaces\Services;

use Illuminate\Database\Eloquent\Model;
use Modules\Notifications\Dtos\NotificationDto;
use Modules\Notifications\Dtos\NotificationRequestDto;
use Modules\Notifications\Dtos\SmsInfoDto;
use Modules\Notifications\Enums\NotificationStatusEnum;

interface NotificationServiceInterface
{
    public function createNotification(
     NotificationRequestDto $dto
    ): void;

    public function sendSmsToProvider(NotificationDto $dto);

    public function findNotification($id): Model;

    public function verifySms(SmsInfoDto $dto);

    public function update(int $id, NotificationStatusEnum $status): bool;

    public function decreaseCountTry($id): void;

    public function failedNotification($id): void;
}
