<?php

namespace Src\Domain\User\Service;

use Src\Domain\User\Repository\ImagesUploaderRepository;

final class ImagesUploader
{
    private $repository;

    public function __construct(ImagesUploaderRepository $repository) {
      $this->repository = $repository;
    }

    public function checkImages($uploadedFiles) {
      if ($error = $this->repository->maximum5($uploadedFiles))
        return ['error' => $error];
      else
        return ['success' => $this->repository->uploadImages($uploadedFiles)];
    }
}
