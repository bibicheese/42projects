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

    public function maximum5($images, $id) {
      $sql = "SELECT * FROM images WHERE
      userid = '$id'"
      $ret = $this->connection->query($sql)->fetchAll(PDO::FETCH_ASSOC);
      if ((count($images) + count($ret)) > 5)
        return [
          'status' => 0,
          'error' => 'max 5 images'
        ];
    }

    public function uploadImages($images, $id) {
      $directory = "../img/";

      foreach ($images as $key => $image) {
        if ($image->getError() === UPLOAD_ERR_OK) {
          $filepath = $this->moveUploadedFile($directory, $image);
          $row = [
            'profil' => $key == "profil" ? 1 : 0,
            'link' => $filepath,
            'userid' => $id
          ];

          $sql = "INSERT INTO images SET
          profil=:profil,
          link=:link,
          userid=:userid;";

          $this->connection->prepare($sql)->execute($row);
        }
      }
      return [
        'status' => 1,
        'success' => 'images saved'
      ];
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
