<?php

namespace Modules\Notifications\Repositories;

use App\Repositories\BaseRepository;
use Illuminate\Database\Eloquent\Model;
use Modules\Notifications\Interfaces\Repositories\NotificationRepositoryInterfaces;
use Modules\Notifications\Models\Notification;

class NotificationRepository extends BaseRepository implements NotificationRepositoryInterfaces
{
    public function __construct(Notification $model)
    {
        $this->model = $model;
    }

}
