<?php

namespace Src\Domain\User\Service;

use Src\Domain\User\Data\UserData;
use Src\Domain\User\Repository\UserAccEditorRepository;

final class UserDataAccEditor
{
    private $repository;

    public function __construct(UserAccEditorRepository $repository) {
        $this->repository = $repository;
    }


    public function checkInterest($interest) {
        return $this->repository->insertInterest($interest);
    }


    public function modifyData(UserData $user): array {
        if ($error = $this->repository->UserExist($user))
          return ['error' => $error];
        else
          return ['success' => $this->repository->insertData($user)];
    }
}
