<?php

namespace Modules\Notifications\Interfaces\Repositories;

use App\Interfaces\Base\BaseRepositoryInterfaces;
use Illuminate\Database\Eloquent\Model;

interface TemplateRepositoryInterfaces extends BaseRepositoryInterfaces
{
    public function findByTopic($topic): ?Model;
}
