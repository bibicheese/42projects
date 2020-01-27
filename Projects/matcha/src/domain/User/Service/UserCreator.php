<?php

namespace Src\Domain\User\Service;

use Src\Domain\User\Data\UserCreateData;
use Src\Domain\User\Repository\UserCreatorRepository;

final class UserCreator
{
    private $repository;

    public function __construct(UserCreatorRepository $repository) {
        $this->repository = $repository;
    }
    public function createUser(UserCreateData $user): array {
        if ($error = $this->repository->UserExist($user))
          return array('error' => $error);
        else
          return $this->repository->insertUser($user);
    }
}
