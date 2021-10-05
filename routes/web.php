<?php

use Slim\Routing\RouteCollectorProxy;
use Slim\App;

use App\Controllers\{
    HomeController,
    ServicesController,
    ProfileController,
    OrdersController,
    LoginController,
    RegisterController
};
use App\Middlewares\AuthMiddleware;

return function (App $app) {
    $app->get('/', HomeController::class . ':index');

    $app->group('/services', function (RouteCollectorProxy $group) {
        $group->get('[/]', ServicesController::class . ':getAllServices');
        $group->get('/{id}', ServicesController::class . ':getOneService');
        $group
            ->get('/{id}/order', ServicesController::class . ':orderService')
            ->add(new AuthMiddleware());
    });

    $app->group('/profile', function (RouteCollectorProxy $group) {
        $group->get('/orders[/{page}]', OrdersController::class . ':getOrders');

        $group->get('/settings', ProfileController::class . ':settings');
        $group->post('/settings/edit', ProfileController::class . ':editSettings');
    })->add(new AuthMiddleware());

    $app->group('/auth', function (RouteCollectorProxy $group) {
        $group->get('/login', LoginController::class . ':index');
        $group->post('/login', LoginController::class . ':login');
        $group->get('/logout', LoginController::class . ':logout');

        $group->get('/register', RegisterController::class . ':index');
        $group->post('/register', RegisterController::class . ':register');
    });
};
