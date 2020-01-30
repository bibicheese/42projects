<?php

namespace Src\Action;

use Src\Domain\User\Service\UserPasswordRecoverer;
use Slim\Http\Response;
use Slim\Http\ServerRequest;


final class RecoverySendTokenAction
{
    private $recoverer;

    public function __construct(UserPasswordRecoverer $recoverer) {
        $this->recoverer = $recoverer;
    }

    public function __invoke(ServerRequest $request, Response $response): Response {
        $data = (array)$request->getParsedBody();

        $result = ['Recovery token status' => $this->recoverer->getToken($data['token'])];
        return $response->withJson($result);
    }
}
