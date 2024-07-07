<?php

namespace Modules\Notifications\Listeners;

use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Modules\Notifications\Events\NotifyEvent;
use Modules\Notifications\Interfaces\Services\SendSmsServiceInterface;

class SmsListener
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(NotifyEvent $event): void
    {
    }
}
