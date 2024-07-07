<?php

namespace Modules\Payment\Interfaces\Repositories;

use App\Interfaces\Base\BaseRepositoryInterfaces;
use Illuminate\Database\Eloquent\Model;

interface TransactionRepositoryInterfaces extends BaseRepositoryInterfaces
{
    public function getLastTenMinuteTransaction();
}
