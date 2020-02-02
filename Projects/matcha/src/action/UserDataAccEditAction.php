<?php

namespace Src\Action;

use Src\Domain\User\service\UserDataAccEditor;
use Src\Domain\User\Data\UserData;
use SlimSession\Helper;
use Slim\Http\Response;
use Slim\Http\ServerRequest;

final class UserDataAccEditAction
{
    private $userDataAccEditor;

    public function __construct(UserDataAccEditor $userDataAccEditor) {
      $this->userDataAccEditor = $userDataAccEditor;
    }

    public function __invoke(ServerRequest $request, Response $response): Response {
        $session = new Helper();
        if (isset($session['id'])){
          $data = (array)$request->getParsedBody();

          $user = $this->fillUser($data);

          $result = ['user_account_status' => $this->userDataAccEditor->modifyData($user)];
        }
        else
          $result = ['user_account_status' => ['error' => 'user not logged']];
        return $response->withJson($result);
    }

    private function fillUser($data): UserData {
      $user = new UserData();
      foreach ($data as $key => $value) {
        if ($key == 'password')
          $user->$key = hash('whirlpool', $value);
        else
          $user->$key = $value;
      }
      return $user;
    }
}
