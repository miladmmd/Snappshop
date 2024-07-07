<?php

namespace Modules\Payment\Dtos;

class P2pTransferDto extends BaseDto
{
    protected ?string $depositorCardNumber;
    protected ?string $recipientCardNumber;
    protected ?int $depositorAccountId;
    protected ?int $recipientAccountId;
    protected ?int $accountBalanceDepositor;
    protected ?int $accountBalanceRecipient;
    protected ?int $userIdDepositor;
    protected ?int $userIdRecipient;

    protected ?int $transferAmount;

    protected ?string $currency;

    protected ?int $depositorCreditCardId;
    protected ?int $recipientCreditCardId;

    protected ?int $feeAmount;

    public function getFeeAmount(): ?int
    {
        return $this->feeAmount;
    }

    public function setFeeAmount(?int $feeAmount): void
    {
        $this->feeAmount = $feeAmount;
    }

    public function getDepositorCreditCardId(): ?int
    {
        return $this->depositorCreditCardId;
    }

    public function setDepositorCreditCardId(?int $depositorCreditCardId): void
    {
        $this->depositorCreditCardId = $depositorCreditCardId;
    }

    public function getRecipientCreditCardId(): ?int
    {
        return $this->recipientCreditCardId;
    }

    public function setRecipientCreditCardId(?int $recipientCreditCardId): void
    {
        $this->recipientCreditCardId = $recipientCreditCardId;
    }

    public function getCurrency(): ?string
    {
        return $this->currency;
    }

    public function setCurrency(?string $currency): void
    {
        $this->currency = $currency;
    }

    public function getDepositorCardNumber(): ?string
    {
        return $this->depositorCardNumber;
    }

    public function setDepositorCardNumber(?string $depositorCardNumber): void
    {
        $this->depositorCardNumber = $depositorCardNumber;
    }

    public function getRecipientCardNumber(): ?string
    {
        return $this->recipientCardNumber;
    }

    public function setRecipientCardNumber(?string $recipientCardNumber): void
    {
        $this->recipientCardNumber = $recipientCardNumber;
    }

    public function getDepositorAccountId(): ?int
    {
        return $this->depositorAccountId;
    }

    public function setDepositorAccountId(?int $depositorAccountId): void
    {
        $this->depositorAccountId = $depositorAccountId;
    }

    public function getRecipientAccountId(): ?int
    {
        return $this->recipientAccountId;
    }

    public function setRecipientAccountId(?int $recipientAccountId): void
    {
        $this->recipientAccountId = $recipientAccountId;
    }

    public function getAccountBalanceDepositor(): ?int
    {
        return $this->accountBalanceDepositor;
    }

    public function setAccountBalanceDepositor(?int $accountBalanceDepositor): void
    {
        $this->accountBalanceDepositor = $accountBalanceDepositor;
    }

    public function getAccountBalanceRecipient(): ?int
    {
        return $this->accountBalanceRecipient;
    }

    public function setAccountBalanceRecipient(?int $accountBalanceRecipient): void
    {
        $this->accountBalanceRecipient = $accountBalanceRecipient;
    }

    public function getUserIdDepositor(): ?int
    {
        return $this->userIdDepositor;
    }

    public function setUserIdDepositor(?int $userIdDepositor): void
    {
        $this->userIdDepositor = $userIdDepositor;
    }

    public function getUserIdRecipient(): ?int
    {
        return $this->userIdRecipient;
    }

    public function setUserIdRecipient(?int $userIdRecipient): void
    {
        $this->userIdRecipient = $userIdRecipient;
    }

    public function getTransferAmount(): ?int
    {
        return $this->transferAmount;
    }

    public function setTransferAmount(?int $transferAmount): void
    {
        $this->transferAmount = $transferAmount;
    }



}
