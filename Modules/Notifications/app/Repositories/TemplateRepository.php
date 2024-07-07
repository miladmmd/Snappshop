<?php

namespace Modules\Notifications\Repositories;

use App\Repositories\BaseRepository;
use Illuminate\Database\Eloquent\Model;
use Modules\Notifications\Interfaces\Repositories\TemplateRepositoryInterfaces;
use Modules\Notifications\Models\Template;

class TemplateRepository extends BaseRepository implements TemplateRepositoryInterfaces
{
    public function __construct(Template $model)
    {
        $this->model = $model;
    }

    public function findByTopic($topic): ?Model
    {
       return $this->query()->where('topic', $topic)->firstOrFail();
    }
}
