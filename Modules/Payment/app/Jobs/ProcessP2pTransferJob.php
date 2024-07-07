<?php

namespace Modules\Payment\Jobs;

use App\JobHandler\QueuedJob;
use Carbon\Carbon;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Modules\Payment\Dtos\P2pTransferDto;
use Modules\Payment\Helpers\DtoHelper;
use Modules\Payment\Interfaces\Services\PaymentServiceInterface;
use Modules\Payment\Interfaces\UseModules\NotificationModuleInterface;
use Modules\Payment\Interfaces\UseModules\UserModuleInterface;

class ProcessP2pTransferJob extends QueuedJob
{
    public $tries = 4;

    protected $retryDelay = [];

    /**
     * Create a new job instance.
     */
    public function __construct(protected P2pTransferDto $dto)
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(
        PaymentServiceInterface $paymentService,
        NotificationModuleInterface $notificationModule,
        UserModuleInterface $userModule
    ): void {
        $dto = $this->dto;

        $this->handleWithRetry(function () use ($dto, $paymentService, $notificationModule, $userModule) {
            DB::beginTransaction();
            try {
                // transactions
                $trackingId = Str::ulid();
                $transactionRecipientDto = DtoHelper::createRecipientTransactionStoreDto($dto, $trackingId);
                $transactionDepositorDto = DtoHelper::createDepositorTransactionStoreDto($dto, $trackingId);
                $paymentService->insertTransactions([
                    $transactionRecipientDto->toArray(),
                    $transactionDepositorDto->toArray(),
                ]);
                $transactionFeeDto = DtoHelper::createFeeTransactionStoreDto($dto, $trackingId);
                $feeTransaction = $paymentService->createTransaction($transactionFeeDto);
                // fee
                $feeDto = DtoHelper::createFeeDto(
                    transactionId: $feeTransaction->getAttribute('id'),
                    amount: $feeTransaction->getAttribute('amount')
                );
                $paymentService->storeFee($feeDto);
                // update account
                $recepientBalance = $transactionRecipientDto->getAmount() + $dto->getAccountBalanceRecipient();
                $paymentService->updateAccountBalance(
                    accountId: $dto->getRecipientAccountId(),
                    balance: $recepientBalance
                );

                $depositorBalance = ($transactionDepositorDto->getAmount() + $dto->getAccountBalanceDepositor(
                    ) + $feeDto->getAmount());
                $paymentService->updateAccountBalance(
                    accountId: $dto->getDepositorAccountId(),
                    balance: $depositorBalance
                );

                // Notification
                $depositorMobile = $userModule->getUser($dto->getUserIdDepositor())->getAttribute('mobile');
                $recipientMobile = $userModule->getUser($dto->getUserIdRecipient())->getAttribute('mobile');
                $depositorArguments = [
                    'account_id' => $dto->getDepositorAccountId(),
                    'amount' => -($transactionDepositorDto->getAmount()),
                    'balance_amount' => $depositorBalance,
                    'date' => Carbon::now()->toString()
                ];
                $recipientArguments = [
                    'account_id' => $dto->getRecipientAccountId(),
                    'amount' => $transactionRecipientDto->getAmount(),
                    'balance_amount' => $recepientBalance,
                    'date' => Carbon::now()->toString()
                ];
                // notification to Depositor
                $notificationModule->sendNotificationDeposit(mobile: $depositorMobile, argument: $depositorArguments);
                // notification to Recipient
                $notificationModule->sendNotificationRecipient(mobile: $recipientMobile, argument: $recipientArguments);
                DB::commit();
            } catch (Exception $e) {

                DB::rollBack();
            }
        });
    }
}
