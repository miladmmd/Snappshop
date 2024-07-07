<?php

namespace Modules\Payment\Dtos;

use DateTime;
use Modules\Payment\Enums\TransactionStatusEnum;
use Modules\Payment\Enums\TransactionTypeEnum;
use Carbon\Carbon;

class StoreTransactionDto extends BaseDto
{
    protected ?int $creditCardId;
    protected ?int $amount;
    protected ?string $clientTracking;
    protected ?string $currency;
    protected ?TransactionTypeEnum $type;
    protected ?TransactionStatusEnum $status;
    protected ?DateTime $createdAt;

    /**
     * @return Carbon
     */
    public function getCreatedAt(): DateTime
    {
        return $this->createdAt;
    }

    /**
     * @param Carbon $createdAt
     */
    public function setCreatedAt(DateTime $createdAt): void
    {
        $this->createdAt = $createdAt;
    }

    public function getCreditCardId(): ?int
    {
        return $this->creditCardId;
    }

    public function setCreditCardId(?int $creditCardId): void
    {
        $this->creditCardId = $creditCardId;
    }

    public function getAmount(): ?int
    {
        return $this->amount;
    }

    public function setAmount(?int $amount): void
    {
        $this->amount = $amount;
    }

    public function getClientTracking(): ?string
    {
        return $this->clientTracking;
    }

    public function setClientTracking(?string $clientTracking): void
    {
        $this->clientTracking = $clientTracking;
    }

    public function getCurrency(): ?string
    {
        return $this->currency;
    }

    public function setCurrency(?string $currency): void
    {
        $this->currency = $currency;
    }

    public function getTransactionTypeEnum(): ?TransactionTypeEnum
    {
        return $this->type;
    }

    public function setTransactionTypeEnum(?TransactionTypeEnum $transactionTypeEnum): void
    {
        $this->type = $transactionTypeEnum;
    }

    public function getTransactionStatusEnum(): ?TransactionStatusEnum
    {
        return $this->status;
    }

    public function setTransactionStatusEnum(?TransactionStatusEnum $transactionStatusEnum): void
    {
        $this->status = $transactionStatusEnum;
    }

}
