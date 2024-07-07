<?php

namespace App\JobHandler;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Arr;
use Throwable;

class QueuedJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $retryDelay = [];

    protected function delayRetry(?Throwable $e = null): bool
    {
        if ($this->job->attempts() >= $this->job->maxTries()) {
            return false;
        }

        $attempt = $this->job->attempts() - 1;
        $retryAfter = Arr::get($this->retryDelay, $attempt, 0);

        $this->job->release($retryAfter);

        return true;
    }

    protected function handleWithRetry($callback): void
    {
        try {
            $callback();
            echo "\033[32m".'job Succeed'.PHP_EOL;
        } catch (Throwable $e) {
            if (!$this->delayRetry($e)) {
                $this->fail($e);
            }
           echo "\033[31m".'job Failed'.PHP_EOL;
        }
    }

}
