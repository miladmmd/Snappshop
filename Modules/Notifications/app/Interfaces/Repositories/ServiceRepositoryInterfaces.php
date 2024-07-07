<?php

namespace Modules\Notifications\Interfaces\Repositories;

use App\Interfaces\Base\BaseRepositoryInterfaces;
use Illuminate\Database\Eloquent\Model;

interface ServiceRepositoryInterfaces extends BaseRepositoryInterfaces
{
    public function findByApiKey($apiKey): ?int;
}
