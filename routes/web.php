<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use Modules\Notifications\Dtos\SmsInfoDto;
use Modules\Notifications\Enums\NotificationTypeEnum;
use Modules\Notifications\Events\NotifyEvent;
use Modules\Notifications\Helpers\DtoHelper;
use Modules\Notifications\Jobs\VerifySmsJob;
use Modules\Payment\Interfaces\Repositories\AccountRepositoryInterface;
use Illuminate\Support\Facades\Redis;


Route::get('/', function (\Modules\Payment\Interfaces\Repositories\TransactionRepositoryInterfaces $transactionRepository) {
   return $transactionRepository->getLastTenMinuteTransaction();
    return 'bank';
});
