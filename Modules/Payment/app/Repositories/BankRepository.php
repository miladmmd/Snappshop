<?php

namespace Modules\Payment\Repositories;

use App\Repositories\BaseRepository;
use Modules\Payment\Interfaces\Repositories\BankRepositoryInterfaces;
use Modules\Payment\Models\Bank;

class BankRepository extends BaseRepository implements BankRepositoryInterfaces
{
    public function __construct(Bank $model)
    {
        $this->model = $model;
    }
}
