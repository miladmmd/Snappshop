<?php

namespace Modules\Notifications\Dtos;

use Modules\Notifications\Enums\NotificationStatusEnum;
use Modules\Notifications\Enums\NotificationTypeEnum;

class NotificationStoreDto extends BaseDto
{
    protected int $mobile;
    protected int $providerId;
    protected int $operatorId;
    protected int $serviceId;
    protected int $templateId;
    protected NotificationTypeEnum $type;
    protected NotificationStatusEnum $status;
    protected ?int $countTry;
    protected array|string $argument;



    public function getCountTry(): ?int
    {
        return $this->countTry;
    }
    public function setCountTry(?int $countTry): void
    {
        $this->countTry = $countTry;
    }

    public function getArgument(): string
    {
        return $this->argument;
    }
    public function setArgument(array $argument): void
    {
        $this->argument = json_encode($argument,true);
    }
    public function getMobile(): int
    {
        return $this->mobile;
    }
    public function setMobile(int $mobile): void
    {
        $this->mobile = $mobile;
    }
    public function getProviderId(): int
    {
        return $this->providerId;
    }
    public function setProviderId(int $providerId): void
    {
        $this->providerId = $providerId;
    }
    public function getOperatorId(): int
    {
        return $this->operatorId;
    }
    public function setOperatorId(int $operatorId): void
    {
        $this->operatorId = $operatorId;
    }
    public function getServiceId(): int
    {
        return $this->serviceId;
    }
    public function setServiceId(int $serviceId): void
    {
        $this->serviceId = $serviceId;
    }
    public function getTemplateId(): int
    {
        return $this->templateId;
    }
    public function setTemplateId(int $templateId): void
    {
        $this->templateId = $templateId;
    }
    public function getType(): NotificationTypeEnum
    {
        return $this->type;
    }
    public function setType(NotificationTypeEnum $type): void
    {
        $this->type = $type;
    }
    public function getStatus(): NotificationStatusEnum
    {
        return $this->status;
    }
    public function setStatus(NotificationStatusEnum $status): void
    {
        $this->status = $status;
    }
}
