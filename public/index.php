<?php

require_once __DIR__ . '/../vendor/autoload.php';

use Slim\Factory\AppFactory;
use Slim\Views\Twig;
use Slim\Views\TwigMiddleware;

use App\Middlewares\SessionMiddleware;

$app = AppFactory::create();

$twig = Twig::create(dirname(__FILE__, 2) . '/resources/views', [
  'cache' => false
]);

$app->add(TwigMiddleware::create($app, $twig));
$app->add(new SessionMiddleware());

$routes = require_once(__DIR__ . '/../routes/web.php');
$routes($app);

$app->run();