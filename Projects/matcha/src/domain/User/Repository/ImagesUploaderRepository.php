<?php

namespace Src\Domain\User\Repository;

use SlimSession\Helper;
use Slim\Http\UploadedFile;
use PDO;

class ImagesUploaderRepository
{
    private $connection;
    private $session;
    private $sess_id;

    public function __construct(PDO $connection, Helper $session) {
      $this->connection = $connection;
      $this->session = $session;
      $this->sess_id = $session['id'];
    }

    public function maximum5($images) {
      $ret = $this->connection->query("SELECT * FROM images WHERE `userid` = '$this->sess_id'")->fetchAll(PDO::FETCH_ASSOC);
      if ((count($images) + count($ret)) > 5)
        return "too much images";
    }

    public function uploadImages($images) {
      $directory = "../src/images/";

      foreach ($images as $key => $image) {
        if ($image->getError() === UPLOAD_ERR_OK) {
          $filepath = $this->moveUploadedFile($directory, $image);
          $row = [
            'profil' => $key == "profil" ? 1 : 0,
            'link' => $filepath,
            'userid' => $this->sess_id
          ];

          $sql = "INSERT INTO images SET
          profil=:profil,
          link=:link,
          userid=:userid;";

          $this->connection->prepare($sql)->execute($row);
        }
      }
      return "images uploaded";
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
