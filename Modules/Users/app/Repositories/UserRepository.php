<?php

namespace Modules\Users\Repositories;

use App\Repositories\BaseRepository;
use Modules\Users\Interfaces\Repositories\UserRepositoryInterface;
use Modules\Users\Models\User;

class UserRepository extends BaseRepository implements UserRepositoryInterface
{
    public function __construct(User $model)
    {
        $this->model = $model;
    }
}
