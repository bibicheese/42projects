<?php

include_once '../config/setup.php';
require '../vendor/autoload.php';

use Slim\Factory\AppFactory;

use Src\action\HomeAction;
use Src\action\UserCreateAction;

$app = AppFactory::create();

$app->get('/', HomeAction::class);
$app->post('/create_user', UserCreateAction::class);

$app->run();

?>
