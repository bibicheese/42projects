<?php

namespace Src\Action;

use Src\Domain\User\Data\UserData;
use Src\Domain\User\Service\UserLIker;
use Slim\Http\Response;
use Slim\Http\ServerRequest;


final class UserLikeAction
{
    private $liker;

    public function __construct(UserLiker $liker) {
        $this->liker = $liker;
    }

    public function __invoke(ServerRequest $request, Response $response): Response {
      $data = (array)$request->getParsedBody();

      $user = new UserData;
      $user->login = $data['login'];
      $result = $this->liker->like($user);

      return $response->withJson($result);
    }
}
