<?php

use Slim\Http\Response;
use Slim\Http\ServerRequest;
use Slim\App;

return function (App $app) {
  $app->get('/', \App\Action\HomeAction::class);
  $app->post('/users', \App\Action\UserCreateAction::class);
};
