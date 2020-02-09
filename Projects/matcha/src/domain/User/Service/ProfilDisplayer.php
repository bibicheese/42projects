<?php

namespace Src\Domain\User\Service;

use Src\Domain\User\Repository\ProfilDisplayerRepository;
use Src\Domain\User\Data\UserData;

final class ProfilDisplayer
{
    private $repository;

    public function __construct(ProfilDisplayerRepository $repository) {
        $this->repository = $repository;
    }

    public function getInfo($user) {
      return $this->repository->Displayer($user);
    }
}
