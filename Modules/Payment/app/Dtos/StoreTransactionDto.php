<?php

namespace Modules\Payment\Dtos;

use Modules\Payment\Enums\TransactionStatusEnum;
use Modules\Payment\Enums\TransactionTypeEnum;

class StoreTransactionDto extends BaseDto
{
    protected ?int $creditCardId;
    protected ?int $amount;
    protected ?string $clientTracking;
    protected ?string $currency;
    protected ?TransactionTypeEnum $type;
    protected ?TransactionStatusEnum $status;

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
