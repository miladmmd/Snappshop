<?php

namespace Modules\Notifications\Dtos;

class TransactionNotificationDto extends BaseDto
{
    protected int $amount;
    protected int $accountId;
    protected int $balanceAmount;


    /**
     * @return int
     */
    public function getAmount(): int
    {
        return $this->amount;
    }

    /**
     * @param int $amount
     */
    public function setAmount(int $amount): void
    {
        $this->amount = $amount;
    }

    /**
     * @return int
     */
    public function getAccountId(): int
    {
        return $this->accountId;
    }

    /**
     * @param int $accountId
     */
    public function setAccountId(int $accountId): void
    {
        $this->accountId = $accountId;
    }

    /**
     * @return int
     */
    public function getBalanceAmount(): int
    {
        return $this->balanceAmount;
    }

    /**
     * @param int $balanceAmount
     */
    public function setBalanceAmount(int $balanceAmount): void
    {
        $this->balanceAmount = $balanceAmount;
    }

}
