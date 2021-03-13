<?php

namespace App\Controllers;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Views\Twig;
use App\Services\Auth;
use App\Models\Service;
use App\Models\Order;

class ServicesController
{
  public function getAllServices(Request $req, Response $res): Response
  {
    $view = Twig::fromRequest($req);

    $services = (new Service())->findAll();

    return $view->render($res, 'pages/services/service-list.twig', [
      'auth' => Auth::check(),
      'services' => $services,
    ]);
  }

  public function getOneService(Request $req, Response $res, array $args): Response
  {
    $view = Twig::fromRequest($req);

    $serviceId = (int) $args['id'];
    $service = (new Service())->findById($serviceId);

    return $view->render($res, 'pages/services/service-view.twig', [
      'auth' => Auth::check(),
      'service' => $service,
    ]);
  }

  public function orderService(Request $req, Response $res, array $args): Response
  {
    $view = Twig::fromRequest($req);

    $order = new Order();

    $order->user_id = (int) Auth::user();
    $order->service_id = (int) $args['id'];

    $status = $order->save();

    return $view->render($res, 'pages/services/service-order.twig', [
      'auth' => Auth::check(),
      'status' => $status,
    ]);
  }
}