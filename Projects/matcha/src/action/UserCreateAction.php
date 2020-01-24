<?php

namespace Src\action;

use Slim\Http\Response;
use Slim\Http\ServerRequest;
use Src\domain\User\Service\UserCreator;
use Src\domain\User\Data\UserData;

final class UserCreateAction
{
    private $userCreator;

    public function __construct(UserCreator $userCreator) {
        $this->userCreator = $userCreator;
    }

    public function __invoke(ServerRequest $request, Response $response): Response {
        $data = (array)$request->getParsedBody();

        $user = new UserData();
        $user->login = $data['login'];
        $user->password = $data['password'];
        $user->email = $data['email'];

        $userId = $this->userCreator->createUser($user);
        $result = ['user_id' => $userId];

        return $response->withJson($result)->withStatus(201);
    }
}

?>
