<?php

namespace Modules\Notifications\Interfaces\Repositories;

use App\Interfaces\Base\BaseRepositoryInterfaces;

interface ProviderOperatorRepositoryInterfaces extends BaseRepositoryInterfaces
{
    public function findByOperator($operator_id): static;
    public function highestPriority(): static;
}
