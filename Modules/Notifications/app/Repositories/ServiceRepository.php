<?php

namespace Modules\Notifications\Repositories;

use App\Helpers\HashHelper;
use App\Repositories\BaseRepository;
use Modules\Notifications\Interfaces\Repositories\ServiceRepositoryInterfaces;
use Modules\Notifications\Models\Service;

class ServiceRepository extends BaseRepository implements ServiceRepositoryInterfaces
{
    public function __construct(Service $model)
    {
        $this->model = $model;
    }
    public function findByApiKey($apiKey): int
    {
        return $this->query()
            ->where('status', true)
            ->get()
            ->filter(function ($transaction) use ($apiKey) {
                return HashHelper::decodeBase64($transaction->hash_api_key, $apiKey);
            })->first()->id;

    }

}
