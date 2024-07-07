<?php

namespace Modules\Payment\Http\Controllers;

use App\Facades\SuccessFacade;
use App\Http\Controllers\Controller;
use Modules\Payment\Interfaces\Services\TransactionServiceInterface;
use Modules\Payment\Transformers\UserTransactionResource;

class TransactionController extends Controller
{
    public function recentTransaction(TransactionServiceInterface $transactionService)
    {
        $data = $transactionService->getLastThreeUserTransaction();
        return SuccessFacade::ok(
            message: "data get successfully.",
            data: new UserTransactionResource(array_values($data))
        );
    }
}
