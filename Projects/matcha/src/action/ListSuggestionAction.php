<?php

namespace Src\Action;

use Slim\Http\Response;
use Slim\Http\ServerRequest;
use Src\Domain\User\Service\ListSuggester;
use SlimSession\Helper;

final class ListSuggestionAction
{
    private $suggester;

    public function __construct(ListSuggester $suggester) {
        $this->suggester = $suggester;
    }

    public function __invoke(ServerRequest $request, Response $response): Response {
        $session = new Helper();
        if ($session['id'])
          $result = $this->suggester->getList($session['id']);
        else
          $result = ['error' => 'user not logged'];
        return $response->withJson($result);
    }
}
