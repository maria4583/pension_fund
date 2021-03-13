<?php

namespace App\Controllers;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Views\Twig;

use App\Services\Auth;

class LoginController
{
  public function index(Request $req, Response $res): Response
  {
    $view = Twig::fromRequest($req);

    return $view->render($res, 'pages/auth/login.twig');
  }

  public function login(Request $req, Response $res): Response
  {
    $data = $req->getParsedBody();

    if (Auth::login($data)) {
      return $res->withStatus(302)->withHeader('Location', '/profile/settings');
    }

    return $res->withStatus(302)->withHeader('Location', '/auth/login');
  }

  public function logout(Request $req, Response $res): Response
  {
    Auth::logout();

    return $res->withStatus(302)->withHeader('Location', '/');
  }
}