<?php

namespace Modules\Notifications\Services\Providers\Sms\Driver;

use DriverNotAllowed;
use Illuminate\Support\Manager;
use Modules\Notifications\Enums\DriverSmsProvidersEnum;
use Modules\Notifications\Services\Providers\Sms\Channels\GhasedakChannel;
use Modules\Notifications\Services\Providers\Sms\Channels\KavenegarChannel;


class SmsProvidersDriver extends Manager
{

    public function getDefaultDriver()
    {
        throw new DriverNotAllowed();
    }

    public function channel(DriverSmsProvidersEnum $driver)
    {
        return $this->driver($driver->value);
    }

    public function createKavenegarChannelDriver()
    {
        return $this->container->make(abstract: KavenegarChannel::class);
    }

    public function createGhasedakChannelDriver()
    {
        return $this->container->make(abstract: GhasedakChannel::class);
    }
}
