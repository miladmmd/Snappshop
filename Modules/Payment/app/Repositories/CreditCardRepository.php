<?php

namespace Modules\Payment\Repositories;

use App\Repositories\BaseRepository;
use Illuminate\Database\Eloquent\Model;
use Modules\Payment\Enums\CreditCardStatusEnum;
use Modules\Payment\Interfaces\Repositories\CreditCardRepositoryInterfaces;
use Modules\Payment\Models\CreditCard;

class CreditCardRepository extends BaseRepository implements CreditCardRepositoryInterfaces
{
    public function __construct(CreditCard $model)
    {
        $this->model = $model;
    }

    public function findByNumber(
        $number,
        array $columns = ['*'],
        array $relations = []
    ): ?Model
    {
       return $this->model
           ->newQuery()
           ->where('number', $number)
           ->where('status', CreditCardStatusEnum::ACTIVE)
          ->with($relations)
           ->firstOrFail($columns);
    }
}
