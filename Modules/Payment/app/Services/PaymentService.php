<?php

namespace Modules\Payment\Services;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;
use Modules\Payment\Dtos\StoreFeeDto;
use Modules\Payment\Dtos\StoreTransactionDto;
use Modules\Payment\Exceptions\P2pException;
use Modules\Payment\Helpers\DtoHelper;
use Modules\Payment\Helpers\PaymentHelper;
use Modules\Payment\Interfaces\Repositories\AccountRepositoryInterface;
use Modules\Payment\Interfaces\Repositories\CreditCardRepositoryInterfaces;
use Modules\Payment\Interfaces\Repositories\FeeRepositoryInterfaces;
use Modules\Payment\Interfaces\Repositories\TransactionRepositoryInterfaces;
use Modules\Payment\Interfaces\Services\PaymentServiceInterface;
use Modules\Payment\Interfaces\UseModules\UserModuleInterface;
use Modules\Payment\Jobs\ProcessP2pTransferJob;

class PaymentService implements PaymentServiceInterface
{

    public function __construct(
        private UserModuleInterface $userModule,
        private CreditCardRepositoryInterfaces $creditCardRepository,
        private TransactionRepositoryInterfaces $transactionRepository,
        private AccountRepositoryInterface $accountRepository,
        private FeeRepositoryInterfaces $feeRepository
    ) {
    }

    public function p2pTransfer(array $formRequest): void
    {
        $lock = Cache::lock($formRequest['from'] . $formRequest['to'], 10);

        if ($lock->get()) {
            try {
                //validate card
                $validateDepositor = PaymentHelper::validateCreditCardNumber($formRequest['from']);
                $validateRecipient = PaymentHelper::validateCreditCardNumber($formRequest['to']);
                throw_if(
                    condition: !$validateRecipient || !$validateDepositor,
                    exception: new P2pException(__("validation.credit_card_invalid"))
                );

                $p2pDto = DtoHelper::createP2pTransferDto(
                    $formRequest,
                    $this->userModule,
                    $this->creditCardRepository
                );
                // check balance of depositor
                throw_if(
                    condition: $p2pDto->getTransferAmount() > $p2pDto->getAccountBalanceDepositor(),
                    exception: new P2pException(__("validation.not_enough_amount"))
                );
                ProcessP2pTransferJob::dispatch($p2pDto);
            } finally {
                $lock->release();
            }
        } else {
            throw new P2pException(__("validation.lock_acquire_failed"));
        }
    }

    public function updateAccountBalance($accountId, $balance): void
    {
        $this->accountRepository->clearQuery()->update(
            modelId: $accountId, payload: [
                'balance' => $balance
            ]
        );
    }

    public function insertTransactions($array): void
    {
        $this->transactionRepository->batchInsert($array);
    }


    public function storeFee(StoreFeeDto $feeDto): void
    {
        $this->feeRepository->create($feeDto->toArray());
    }

    public function createTransaction(StoreTransactionDto $dto): Model
    {
        return $this->transactionRepository->create($dto->toArray());
    }

}
