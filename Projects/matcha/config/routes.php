<?php

use Slim\Http\Response;
use Slim\Http\ServerRequest;
use Slim\App;

return function (App $app) {
  $app->get('/', \Src\Action\HomeAction::class);
  $app->post('/create_user', \Src\Action\UserCreateAction::class);
  $app->post('/login', \Src\Action\UserLoginAction::class);
  $app->post('/logout', \Src\Action\UserLogoutAction::class);
  $app->post('/account_editor', \Src\Action\UserDataAccEditAction::class);
};
