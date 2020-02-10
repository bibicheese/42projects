<?php

use Slim\Http\Response;
use Slim\Http\ServerRequest;
use Slim\App;

return function (App $app) {
  $app->get('/home', \Src\Action\HomeAction::class);
  $app->post('/create_user', \Src\Action\UserCreateAction::class);
  $app->post('/login', \Src\Action\UserLoginAction::class);
  $app->post('/logout', \Src\Action\UserLogoutAction::class);
  $app->post('/account_editor', \Src\Action\UserDataAccEditAction::class);
  $app->post('/recovery_password', \Src\Action\RecoveryPasswordAction::class);
  $app->post('/images', \Src\Action\UploadImagesAction::class);
  $app->get('/profil/{login}', \Src\Action\ViewProfilAction::class);
  $app->get('/suggest_list', \Src\Action\ListSuggestionAction::class);
  $app->post('/like', \Src\Action\UserLikeAction::class);
  $app->get('/my_account', \Src\Action\ViewSelfProfilAction::class);
};
