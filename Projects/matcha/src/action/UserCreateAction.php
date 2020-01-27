<?php

namespace Src\Action;

use Src\Domain\User\Data\UserCreateData;
use Src\Domain\User\Service\UserCreator;
use Slim\Http\Response;
use Slim\Http\ServerRequest;

final class UserCreateAction
{
    private $userCreator;

    public function __construct(UserCreator $userCreator) {
        $this->userCreator = $userCreator;
    }

    public function __invoke(ServerRequest $request, Response $response): Response {
        $data = (array)$request->getParsedBody();

        $user = new UserCreateData();
        $user->login = $data['login'];
        $user->password = $data['password'];
        $user->email = $data['email'];

        $status = $this->userCreator->createUser($user);

        $result = ['create_user_status' => $status];

        return $response->withJson($result);
    }
}
