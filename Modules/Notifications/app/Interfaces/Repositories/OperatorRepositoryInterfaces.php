<?php

namespace Modules\Notifications\Interfaces\Repositories;

use App\Interfaces\Base\BaseRepositoryInterfaces;
use Illuminate\Database\Eloquent\Model;

interface OperatorRepositoryInterfaces extends BaseRepositoryInterfaces
{
    public function findOperatorByMobileNumber($mobile, array $columns = ['*']): ?Model;
}
