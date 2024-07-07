<?php

namespace Modules\Notifications\Facades\Providers;

use Illuminate\Support\Facades\Facade;
use Modules\Notifications\Services\Providers\Sms\Driver\SmsProvidersDriver;

class SmsProviderDetectorFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        $class = SmsProvidersDriver::class;
        static::clearResolvedInstance($class);
        return $class;
    }
}
