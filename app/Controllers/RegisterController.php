<?php

namespace App\Controllers;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Views\Twig;

use App\Models\User;

class RegisterController
{
  public function index(Request $req, Response $res): Response
  {
    $view = Twig::fromRequest($req);

    return $view->render($res, 'pages/auth/register.twig');
  }

  public function register(Request $req, Response $res): Response
  {
    $data = $req->getParsedBody();

    $user = new User();

    $user->name = $data['name'];
    $user->surname = $data['surname'];
    $user->middle_name = $data['middle_name'];
    $user->email = $data['email'];
    $user->phone = $data['phone'] ?? '';
    $user->password = password_hash($data['password'], PASSWORD_BCRYPT);

    $user->save();

    return $res->withStatus(302)->withHeader('Location', '/auth/login');
  }
}