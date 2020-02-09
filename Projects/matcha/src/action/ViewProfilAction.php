<?php

namespace Src\Action;

use Src\Domain\User\Data\UserData;
use Src\Domain\User\Service\ProfilDisplayer;
use Slim\Http\Response;
use Slim\Http\ServerRequest;


final class ViewProfilAction
{
    private $displayer;

    public function __construct(ProfilDisplayer $displayer) {
      $this->displayer = $displayer;
    }

    public function __invoke(ServerRequest $request, Response $response, $args): response {
      $user = new UserData();
      $user->login = $args['login'];

      $result = ['profil' => $this->displayer->getInfo($user)];

      return $response->withJson($result);
    }
}
