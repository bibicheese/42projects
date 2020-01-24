<?php

namespace Src\action;

use Slim\Http\Response;
use Slim\Http\ServerRequest;

class HomeAction {
    public function __invoke(ServerRequest $request, Response $response): Response {
        $result = ['error' => ['message' => 'Validation failed']];
        return $response->withJson($result);
    }
}

?>
