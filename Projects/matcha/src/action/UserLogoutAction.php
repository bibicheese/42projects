<?php

namespace Src\Action;

use Src\Domain\User\Service\UserDelogger;
use Slim\Http\Response;
use Slim\Http\ServerRequest;


final class UserLogoutAction
{
    private $userDelogger;

    public function __construct(UserDelogger $userDelogger) {
      $this->userDelogger = $userDelogger;
    }

    public function __invoke(ServerRequest $request, Response $response): Response {
        $status = $this->userDelogger->DelogUser();

        $result = ['delog_user_status' => $status];

        return $response->withJson($result);
    }
}
