<?php

namespace Modules\Notifications\Services;

use Illuminate\Database\Eloquent\Model;
use Modules\Notifications\Dtos\SmsInfoDto;
use Modules\Notifications\Enums\SmsInfoStatusEnum;
use Modules\Notifications\Interfaces\Repositories\SmsInfoRepositoryInterface;
use Modules\Notifications\Interfaces\Services\SmsInfoServiceInterface;

class SmsInfoService implements SmsInfoServiceInterface
{
    public function __construct(protected SmsInfoRepositoryInterface $smsInfoRepository)
    {
    }

    public function create(SmsInfoDto $dto): ?Model
    {
       return $this->smsInfoRepository->create($dto->toArray());
    }

    public function find(int $id): Model
    {
        return $this->smsInfoRepository->findByIdOrFail(modelId: $id);
    }

    public function updateStatus(int $id,int $status): bool
    {
       return $this->smsInfoRepository->update($id,[
            'status' => $status
        ]);
    }

    public function batchFailedStatus(array $ids): bool
    {
        return $this->smsInfoRepository->batchUpdate($ids,[
            'status' => SmsInfoStatusEnum::FAILED->value
        ]);
    }
}
