<?php

namespace Src\Action;

use Src\Domain\User\Data\UserloginData;
use Src\Domain\User\Service\Userlogger;
use Slim\Http\Response;
use Slim\Http\ServerRequest;
use \SlimSession\Helper;

final class AccountAction
{
    // private $userLogger;
    //
    // public function __construct(UserLogger $userLogger) {
    //   $this->userLogger = $userLogger;
    // }

    public function __invoke(ServerRequest $request, Response $response): Response {
        $session = new Helper();
        if (isset($session['id'])){
            $id = $session['id'];
            $result = ['user' => "$id : logged"];
        }
        else
          $result = ['user' => 'not logged'];
        return $response->withJson($result);
    }
}
