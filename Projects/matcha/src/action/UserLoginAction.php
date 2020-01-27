<?php

namespace Src\Action;

use Src\Domain\User\Data\UserloginData;
use Src\Domain\User\Service\Userlogger;
use Slim\Http\Response;
use Slim\Http\ServerRequest;

final class UserLoginAction
{
    private $userLogger;

    public function __construct(UserLogger $userLogger) {
      $this->userLogger = $userLogger;
    }

    public function __invoke(ServerRequest $request, Response $response): Response {
      $data = (array)$request->getParsedBody();

      $user = new UserLoginData();
      $user->login = $data['login'];
      $user->password = $data['password'];

      $status = $this->userLogger->LoginUser($user);

      $result = ['login_user_status' => ['user_id' => $status]];

      return $response->withJson($result);
    }
}
