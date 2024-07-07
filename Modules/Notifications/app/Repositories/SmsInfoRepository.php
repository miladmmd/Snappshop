<?php

namespace Modules\Notifications\Repositories;

use App\Repositories\BaseRepository;
use Modules\Notifications\Interfaces\Repositories\SmsInfoRepositoryInterface;
use Modules\Notifications\Models\SmsInfo;

class SmsInfoRepository extends BaseRepository implements SmsInfoRepositoryInterface
{
    public function __construct(SmsInfo $model)
    {
        $this->model = $model;
    }
}
