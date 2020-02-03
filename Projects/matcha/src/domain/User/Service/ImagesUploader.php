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
        return $this->repository->uploadImages($uploadedFiles);
    }
}
