<?php

namespace Modules\Payment\Repositories;

use App\Repositories\BaseRepository;
use Modules\Payment\Interfaces\Repositories\AccountRepositoryInterface;
use Modules\Payment\Models\Account;

class AccountRepository extends BaseRepository implements AccountRepositoryInterface
{
    public function __construct(Account $model)
    {
        $this->model = $model;
    }
}
