<?php

namespace Modules\Payment\Interfaces\Services;

use Illuminate\Database\Eloquent\Model;
use Modules\Payment\Dtos\StoreFeeDto;
use Modules\Payment\Dtos\StoreTransactionDto;

interface PaymentServiceInterface
{
    public function p2pTransfer(array $formRequest): void;

    public function updateAccountBalance($accountId,$balance): void;

    public function insertTransactions($array): void;
    public function storeFee(StoreFeeDto $feeDto): void;

    public function createTransaction(StoreTransactionDto $dto): Model;

}
