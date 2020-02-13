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


    public function modifyData(UserData $user) {
        if ($error = $this->repository->UserExist($user, $id))
          return ['status' => 0, 'error' => $error];
        else
          return ['stauts' => 1, 'success' => $this->repository->insertData($user, $id)];
    }
}
