<?php

namespace Src\Domain\User\Service;

use Src\Domain\User\Data\UserData;
use Src\Domain\User\Repository\UserCreatorRepository;

final class UserCreator
{
    private $repository;

    public function __construct(UserCreatorRepository $repository) {
        $this->repository = $repository;
    }
    public function createUser(UserData $user): array {
        if ($error = $this->repository->UserExist($user))
          return ['error' => $error . " taken"];
        else
          return ['success' => $this->repository->insertUser($user)];
    }
}
