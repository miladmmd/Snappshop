<?php

namespace Modules\Notifications\Repositories;

use App\Repositories\BaseRepository;
use Illuminate\Database\Eloquent\Model;
use Modules\Notifications\Interfaces\Repositories\OperatorRepositoryInterfaces;
use Modules\Notifications\Models\Operator;

class OperatorRepository extends BaseRepository implements OperatorRepositoryInterfaces
{
    public function __construct(Operator $model)
    {
        $this->model = $model;
    }

    public function findOperatorByMobileNumber($mobile,array $columns = ['*']): ?Model
    {
        return $this
            ->query()
            ->select($columns)
            ->whereRaw("? REGEXP regex",[$mobile])
            ->first();
    }
}
