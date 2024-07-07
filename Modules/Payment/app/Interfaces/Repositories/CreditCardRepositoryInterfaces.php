<?php

namespace Modules\Payment\Interfaces\Repositories;

use App\Interfaces\Base\BaseRepositoryInterfaces;
use Illuminate\Database\Eloquent\Model;

interface CreditCardRepositoryInterfaces extends BaseRepositoryInterfaces
{

    public function findByNumber(
        $number,
        array $columns = ['*'],
        array $relations = []
    ): ?Model;
}
