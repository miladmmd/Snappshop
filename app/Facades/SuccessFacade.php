<?php

namespace App\Facades;

use App\Responses\Success;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Facade;

/**
 * @method static JsonResponse ok(array|string $message = null, array|JsonResource|Collection $data = [])
 * @method static JsonResponse created(array|string $message = null, array|JsonResource|Collection $data = [])
 */
class SuccessFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        $class = Success::class;
        static::clearResolvedInstance($class);
        return $class;
    }
}
