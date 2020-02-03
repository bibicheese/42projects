<?php

namespace Src\Domain\User\Repository;

use Slim\Http\UploadedFile;
use PDO;

class ImagesUploaderRepository
{
    private $connection;

    public function __construct(PDO $connection) {
      $this->connection = $connection;
    }

    public function uploadImages($images) {
      $directory = "/../src/images/";

      foreach ($images as $key => $image) {
        if ($image->getError() === UPLOAD_ERR_OK) {
          $filepath = $this->moveUploadedFile($directory, $image);
          // $row = [
          //   'profile' => $key == "profile" ? 1
          // ]
        }
        $result = $result . "uploaded " . $filepath;
      }
      return $result;
    }

    private function moveUploadedFile($directory, $uploadedFile) {
    $extension = pathinfo($uploadedFile->getClientFilename(), PATHINFO_EXTENSION);
    $basename = bin2hex(random_bytes(8));
    $filename = sprintf('%s.%0.8s', $basename, $extension);
    $filepath = $directory . DIRECTORY_SEPARATOR . $filename;

    $uploadedFile->moveTo($filepath);

    return $filepath;
  }
}
