<?php

namespace Src\Action;

use SlimSession\Helper;
use Src\Domain\User\Service\SelfProfilDisplayer;
use Slim\Http\Response;
use Slim\Http\ServerRequest;


final class ViewSelfProfilAction
{
    private $displayer;

    public function __construct(SelfProfilDisplayer $displayer) {
      $this->displayer = $displayer;
    }

    public function __invoke(ServerRequest $request, Response $response, $args): response {
        $session = new Helper();
        if ($id = $session['id']) {
          $result = $this->displayer->getProfil($id);
        }
        else {
          $result = ['error' => 'user not logged'];
        }

        return $response->withJson($result);
    }
}
