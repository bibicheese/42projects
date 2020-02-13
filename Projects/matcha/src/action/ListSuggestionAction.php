<?php

namespace Src\Action;

use Slim\Http\Response;
use Slim\Http\ServerRequest;
use Src\Domain\User\Data\UserAuth;
use Src\Domain\User\Service\ListSuggester;
use Src\Domain\User\Repository\checkUserLoggedRepository;

final class ListSuggestionAction
{
    private $suggester;
    private $checkAuth;

    public function __construct(ListSuggester $suggester, checkUserLoggedRepository $checkAuth) {
        $this->suggester = $suggester;
        $this->checkAuth = $checkAuth;
    }

    public function __invoke(ServerRequest $request, Response $response): Response {
        $log = $request->getQueryParams();
        
        $userAuth = new UserAuth();
        $userAuth->id = $log['id'];
        $userAuth->token = $log['token'];
        
        if ($status = $this->checkAuth->check($userAuth))
          $result = ['status' => 0, 'error' => $status];
        else
          $result = ['status' => 1, 'success' => $this->suggester->getList($userAuth->id)];
        
        return $response->withJson($result);
    }
}
