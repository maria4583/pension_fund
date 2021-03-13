<?php

namespace App\Controllers;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Views\Twig;
use App\Services\Auth;
use App\Models\Service;

class HomeController
{
  public function index(Request $req, Response $res): Response 
  {
    $view = Twig::fromRequest($req);

    $services = (new Service())->findAll();
    $servicesSlice = array_slice($services, 0, 3);

    return $view->render($res, 'pages/home/home.twig', [
      'auth' => Auth::check(),
      'services' => $servicesSlice,
    ]);
  }
}