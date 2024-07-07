<?php

namespace Modules\Payment\Services;

use Modules\Payment\Interfaces\Repositories\TransactionRepositoryInterfaces;
use Modules\Payment\Interfaces\Services\TransactionServiceInterface;

class TransactionService implements TransactionServiceInterface
{
    public function __construct(protected TransactionRepositoryInterfaces $transactionRepository)
    {
    }

    public function getLastThreeUserTransaction()
    {
        return $this->transactionRepository->getLastTenMinuteTransaction();
    }
}
