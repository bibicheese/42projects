<?php

namespace Src\Action;

use SlimSession\Helper;
use Src\Domain\User\Service\ImagesUploader;
use Slim\Http\Response;
use Slim\Http\ServerRequest;


final class UploadImagesAction
{
    private $imagesUploader;

    public function __construct(ImagesUploader $imagesUploader) {
        $this->imagesUploader = $imagesUploader;
    }

    public function __invoke(ServerRequest $request, Response $response): Response {
      $session = new Helper();
      if (isset($session['id'])) {
        $uploadedFiles = $request->getUploadedFiles();

        $result = ['images_upload_status' => $this->imagesUploader->checkImages($uploadedFiles)];
      }
      else
        $result = ['images_upload_status' => ['error' => 'user not logged']];
      return $response->withJson($result);
    }
}
