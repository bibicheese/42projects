<?php

namespace Src\Action;

use Src\Domain\User\Data\UserData;
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
      $data = $request->getParsedBody();

      $user = new UserData();
      $user->email = $data['email'];
      $user->password = hash('whirlpool', $data['password']);

      $status = $this->userLogger->LoginUser($user);

      if ($status['success']) {
      
          $id = $status;
          $result = ['status' => 1, 'id' => $status['success']['id'], 'token' => $status['token']];
      }
      else
        $result = ['status' => 0, 'error' => $status['error']];
      
      return $response->withJson($result);
    }
}
