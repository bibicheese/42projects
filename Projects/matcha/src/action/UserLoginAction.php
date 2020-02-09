<?php

namespace Src\Action;

use Src\Domain\User\Data\UserData;
use Src\Domain\User\Service\Userlogger;
use SlimSession\Helper;
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

      $user = new UserData();
      $user->email = $data['email'];
      $user->password = hash('whirlpool', $data['password']);

      $status = $this->userLogger->LoginUser($user);

      if (is_numeric($status)) {
          $session = new Helper();
          $session['id'] = $status;
          $id = $session['id'];
          $result = ['login_user_status' => ['success' => "$id : user logged"]];
      }
      else
        $result = ['login_user_status' => ['error' => $status]];

      return $response->withJson($result);
    }
}
