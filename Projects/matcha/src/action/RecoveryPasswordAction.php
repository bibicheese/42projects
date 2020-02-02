<?php

namespace Src\Action;

use Src\Domain\User\Service\UserPasswordRecoverer;
use Slim\Http\Response;
use Slim\Http\ServerRequest;


final class RecoveryPasswordAction
{
    private $recoverer;

    public function __construct(UserPasswordRecoverer $recoverer) {
        $this->recoverer = $recoverer;
    }

    public function __invoke(ServerRequest $request, Response $response): Response {
        $data = (array)$request->getParsedBody();

        if ($data['email'])
          $result = ['Recovery mail status' =>  $this->recoverer->prepareMail($data['email'])];
        else if ($data['token'])
          $result = ['Recovery token status' => $this->recoverer->getToken($data['token'])];
        else if ($data['password']) {
          $password = hash('whirlpool', $data['password']);
          $result = ['Recovery password status' => $this->recoverer->changePassword($password)];
        }

        return $response->withJson($result);
    }
}
