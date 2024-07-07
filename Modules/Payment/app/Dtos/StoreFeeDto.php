<?php

namespace Modules\Payment\Dtos;

class StoreFeeDto extends BaseDto
{
    protected ?int $transactionId;
    protected ?int $amount;
    public function getTransactionId(): ?int
    {
        return $this->transactionId;
    }

    public function setTransactionId(int $transactionId): void
    {
        $this->transactionId = $transactionId;
    }

    public function getAmount(): ?int
    {
        return $this->amount;
    }

    public function setAmount(int $amount): void
    {
        $this->amount = $amount;
    }

}
