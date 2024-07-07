<?php

namespace Modules\Notifications\Repositories;

use App\Repositories\BaseRepository;
use Modules\Notifications\Interfaces\Repositories\ProviderOperatorRepositoryInterfaces;
use Modules\Notifications\Models\ProviderOperator;

class ProviderOperatorRepository extends BaseRepository implements ProviderOperatorRepositoryInterfaces
{
    public function __construct(ProviderOperator $model)
    {
        $this->model = $model;
    }

    public function findByOperator($operator_id): static
    {
        $this->query()->where('operator_id',$operator_id);
        return $this;
    }

    public function highestPriority(): static
    {
        $this->query()->where('priority', $this->query()->min('priority'));
        return $this;
    }
}
