<?php

namespace Modules\Notifications\Repositories;

use App\Repositories\BaseRepository;
use Modules\Notifications\Interfaces\Repositories\ProviderRepositoryInterfaces;
use Modules\Notifications\Models\Provider;

class ProviderRepository extends BaseRepository implements ProviderRepositoryInterfaces
{
    public function __construct(Provider $model)
    {
        $this->model = $model;
    }
}
