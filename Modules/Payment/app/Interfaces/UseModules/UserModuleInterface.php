<?php

namespace Modules\Payment\Interfaces\UseModules;

use Illuminate\Database\Eloquent\Model;

interface UserModuleInterface
{
    public function getUser($id): ?Model;
}
