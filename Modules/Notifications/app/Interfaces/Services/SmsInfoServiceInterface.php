<?php

namespace Modules\Notifications\Interfaces\Services;

use Illuminate\Database\Eloquent\Model;
use Modules\Notifications\Dtos\SmsInfoDto;

interface SmsInfoServiceInterface
{
    public function create(SmsInfoDto $dto): ?Model;

    public function find(int $id): Model;

    public function updateStatus(int $id,int $status): bool;

    public function batchFailedStatus(array $ids): bool;
}
