<?php

namespace Src\Action;

use Slim\Http\Response;
use Slim\Http\ServerRequest;

final class HomeAction
{
    public function __invoke(ServerRequest $request, Response $response): Response
    {
        $response->getBody()->write('Hello, World!');

        return $response;
    }
}
