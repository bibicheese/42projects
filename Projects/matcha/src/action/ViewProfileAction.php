<?php

namespace Src\Action;

use Slim\Http\Response;
use Slim\Http\ServerRequest;


final class ViewProfileAction
{
    // private $profileData;
    //
    // public function __construct(ProfileViewer $profileData) {
    //   $this->$profileData = $profileData;
    // }

    public function __invoke(ServerRequest $request, Response $response, $args): response {
      $msg = "hello " . $args['name'];
      return $response->withJson($msg);
    }
}
