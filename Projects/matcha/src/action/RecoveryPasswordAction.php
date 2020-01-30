<?php

namespace Src\Action;

use Src\Domain\User\Service\UserPasswordRecoverer;
use Slim\Http\Response;
use Slim\Http\ServerRequest;


final class RecoverySendMailAction
{
    private $recoverer;

    public function __construct(UserPasswordRecoverer $recoverer) {
        $this->recoverer = $recoverer;
    }

    public function __invoke(ServerRequest $request, Response $response): Response {
        $data = (array)$request->getParsedBody();

        $result = ['Recovery mail status' => $this->recoverer->changePassword($data['password'])];
        return $response->withJson($result);
    }
}
