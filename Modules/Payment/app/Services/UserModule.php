<?php

namespace Modules\Payment\Services;

use Illuminate\Database\Eloquent\Model;
use Modules\Payment\Interfaces\UseModules\UserModuleInterface;
use Modules\Users\Interfaces\Repositories\UserRepositoryInterface;

class UserModule implements UserModuleInterface
{
 public function __construct(private UserRepositoryInterface $userRepository)
 {
 }

    public function getUser($id): ?Model
    {
        return $this->userRepository->clearQuery()->findById($id);
    }
}
