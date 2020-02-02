<?php

namespace Src\Action;

use Src\Domain\User\Service\UserActivator;
use Slim\Http\Response;
use Slim\Http\ServerRequest;

final class HomeAction
{
    private $userActivator;

    public function __construct(UserActivator $userActivator) {
      $this->userActivator = $userActivator;
    }

    public function __invoke(ServerRequest $request, Response $response): Response {
        $data = $request->getQueryParams();

        if ($data['token'])
          $result = ['home' => $this->userActivator->getToken($data['token'])];
        else
          $result = ['home' => 'Hello, Wolrd!'];

        return $response->withJson($result);;
    }
}
