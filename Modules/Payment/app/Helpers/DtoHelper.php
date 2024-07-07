<?php

namespace Modules\Payment\Helpers;

use Modules\Payment\Dtos\P2pTransferDto;
use Modules\Payment\Dtos\StoreFeeDto;
use Modules\Payment\Dtos\StoreTransactionDto;
use Modules\Payment\Enums\TransactionStatusEnum;
use Modules\Payment\Enums\TransactionTypeEnum;
use Modules\Payment\Interfaces\Repositories\CreditCardRepositoryInterfaces;
use Modules\Payment\Interfaces\UseModules\UserModuleInterface;

class DtoHelper
{

    public static function createP2pTransferDto(
        array $payload,
        UserModuleInterface $userModule,
        CreditCardRepositoryInterfaces $creditCardRepository
    ): P2pTransferDto
    {
        $dto = new P2pTransferDto();
        $dto->setDepositorCardNumber($payload['from']);
        $dto->setRecipientCardNumber($payload['to']);
        $dto->setTransferAmount($payload['amount']);
        $depositorAccount = $creditCardRepository->findByNumber(number: $payload['from'], relations: ['account']);
        $recipientAccount = $creditCardRepository->findByNumber($payload['to'], relations: ['account']);
        // set creditCardId
        $dto->setDepositorCreditCardId($depositorAccount->getAttribute('id'));
        $dto->setRecipientCreditCardId($recipientAccount->getAttribute('id'));
        // set account id
        $dto->setDepositorAccountId($depositorAccount->getAttribute('account_id'));
        $dto->setRecipientAccountId($recipientAccount->getAttribute('account_id'));
        //set user id
        $dto->setUserIdDepositor($depositorAccount->getRelation('account')->user_id);
        $dto->setUserIdRecipient($recipientAccount->getRelation('account')->user_id);
        //set account balance
        $dto->setAccountBalanceRecipient($recipientAccount->getRelation('account')->balance);
        $dto->setAccountBalanceDepositor($depositorAccount->getRelation('account')->balance);

        $dto->setCurrency('IRR');
        $dto->setFeeAmount(-(config('settings.system_commission')));
        return $dto;
    }

    public static function createRecipientTransactionStoreDto(P2pTransferDto $transferDto,string $clientTrackingId): StoreTransactionDto
    {

        $dto = new StoreTransactionDto();
        $dto->setAmount($transferDto->getTransferAmount());
        $dto->setClientTracking($clientTrackingId);
        $dto->setCurrency($transferDto->getCurrency());
        $dto->setCreditCardId($transferDto->getRecipientCreditCardId());
        $dto->setTransactionStatusEnum(TransactionStatusEnum::SUCCESS);
        $dto->setTransactionTypeEnum(TransactionTypeEnum::CREDIT);
        return $dto;
    }

    public static function createDepositorTransactionStoreDto(P2pTransferDto $transferDto,string $clientTrackingId): StoreTransactionDto
    {

        $dto = new StoreTransactionDto();
        $dto->setAmount(-($transferDto->getTransferAmount()));
        $dto->setClientTracking($clientTrackingId);
        $dto->setCurrency($transferDto->getCurrency());
        $dto->setCreditCardId($transferDto->getDepositorCreditCardId());
        $dto->setTransactionStatusEnum(TransactionStatusEnum::SUCCESS);
        $dto->setTransactionTypeEnum(TransactionTypeEnum::DEBIT);
        return $dto;
    }

    public static function createFeeTransactionStoreDto(P2pTransferDto $transferDto,string $clientTrackingId)
    {
        $dto = new StoreTransactionDto();
        $dto->setAmount($transferDto->getFeeAmount());
        $dto->setClientTracking($clientTrackingId);
        $dto->setCurrency($transferDto->getCurrency());
        $dto->setCreditCardId($transferDto->getDepositorCreditCardId());
        $dto->setTransactionStatusEnum(TransactionStatusEnum::SUCCESS);
        $dto->setTransactionTypeEnum(TransactionTypeEnum::DEBIT);
        return $dto;
    }

    public static function createFeeDto(int $transactionId,int $amount): StoreFeeDto
    {
        $dto =  new StoreFeeDto();
        $dto->setTransactionId($transactionId);
        $dto->setAmount($amount);
        return $dto;
    }



}
