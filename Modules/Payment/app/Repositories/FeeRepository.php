<?php

namespace Modules\Payment\Repositories;

use App\Interfaces\Base\BaseRepositoryInterfaces;
use App\Repositories\BaseRepository;
use Modules\Payment\Interfaces\Repositories\FeeRepositoryInterfaces;
use Modules\Payment\Models\Fee;

class FeeRepository extends BaseRepository implements FeeRepositoryInterfaces
{
    public function __construct(Fee $model)
    {
        $this->model = $model;
    }

}
