<?php

namespace Modules\Payment\Http\Controllers;

use App\Facades\SuccessFacade;
use App\Http\Controllers\Controller;
use Modules\Payment\Http\Requests\P2pRequest;
use Modules\Payment\Interfaces\Services\PaymentServiceInterface;

class CreditCardController extends Controller
{
    public function p2p(P2pRequest $request, PaymentServiceInterface $paymentService)
    {
        $paymentService->p2pTransfer($request->validated());
        return SuccessFacade::created(
            message: __('data created successfully'),
        );
    }

}
