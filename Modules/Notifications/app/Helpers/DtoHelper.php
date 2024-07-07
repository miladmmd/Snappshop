<?php

namespace Modules\Notifications\Helpers;

use Modules\Notifications\Dtos\NotificationDto;
use Modules\Notifications\Dtos\NotificationRequestDto;
use Modules\Notifications\Dtos\NotificationStoreDto;
use Modules\Notifications\Enums\NotificationStatusEnum;
use Modules\Notifications\Enums\NotificationTypeEnum;

class DtoHelper
{


    public static function createNotificationRequestDto(
        string $templateTopic,
        NotificationTypeEnum $type,
        array $arguments,
        ?string $apiKey,
        ?int $mobile = null,
        ?string $email = null,
    ): NotificationRequestDto
    {
        $dto = new NotificationRequestDto();
        if (!is_null($email))
        {
            $dto->setEmail($email);
        }

        $dto->setTemplateTopic($templateTopic);
        $dto->setMobile($mobile);
        $dto->setArguments($arguments);
        $dto->setTypeEnum($type);
        $dto->setApiKey($apiKey);
        return $dto;
    }

    public static function createStoreNotificationDto (
        int $mobile,
        NotificationTypeEnum $type,
        array $argument,
        int $serviceId,
        int $operatorId,
        int $providerId,
        int $templateId

    ):NotificationStoreDto
    {
        $notificationStoreDto = new NotificationStoreDto();
        $notificationStoreDto->setMobile($mobile);
        $notificationStoreDto->setServiceId($serviceId);
        $notificationStoreDto->setStatus(NotificationStatusEnum::PENDING);
        $notificationStoreDto->setType($type);
        $notificationStoreDto->setOperatorId($operatorId);
        $notificationStoreDto->setProviderId($providerId);
        $notificationStoreDto->setArgument($argument);
        $notificationStoreDto->setTemplateId($templateId);
        return $notificationStoreDto;
    }

    public static function createNotificationDto(
        int $mobile,
        NotificationTypeEnum $type,
        array $argument,
        int $serviceId,
        int $operatorId,
        int $providerId,
        int $templateId,
        int $id,
        NotificationStatusEnum $notificationStatusEnum
    ): NotificationDto
    {
        $notificationDto = new NotificationDto();
        $notificationDto->setMobile($mobile);
        $notificationDto->setServiceId($serviceId);
        $notificationDto->setStatus($notificationStatusEnum);
        $notificationDto->setType($type);
        $notificationDto->setOperatorId($operatorId);
        $notificationDto->setProviderId($providerId);
        $notificationDto->setArgument($argument);
        $notificationDto->setTemplateId($templateId);
        $notificationDto->setId($id);
        return $notificationDto;
    }



//    public static function createDepositTransactionNotificationDto (
//        int $mobile,
//        int $amount,
//        int $accountId,
//        int $balance
//    ): TransactionNotificationDto
//    {
//        $dto = new TransactionNotificationDto();
//        $dto->setMobile($mobile);
//        $dto->setAmount($amount);
//        $dto->setAccountId($accountId);
//        $dto->setBalanceAmount($balance);
//        $dto->setTemplateTopic(config('templates.payment.deposit_transaction'));
//        $dto->setTypeEnum(NotificationTypeEnum::SMS);
//        return $dto;
//    }
//
//    public static function createWithDrawTransactionNotificationDto (
//        int $mobile,
//        int $amount,
//        int $accountId,
//        int $balance
//    ): TransactionNotificationDto
//    {
//        $dto = new TransactionNotificationDto();
//        $dto->setMobile($mobile);
//        $dto->setAmount($amount);
//        $dto->setAccountId($accountId);
//        $dto->setBalanceAmount($balance);
//        $dto->setTemplateTopic(config('templates.payment.withdraw_transaction'));
//        $dto->setTypeEnum(NotificationTypeEnum::SMS);
//        return $dto;
//    }
}
