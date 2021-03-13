<?php

namespace App\Controllers;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Views\Twig;
use Core\Session;
use App\Services\Auth;
use App\Models\User;

class ProfileController
{

  public function settings(Request $req, Response $res): Response
  {
    $view = Twig::fromRequest($req);

    $userId = Session::getData('user');
    $user = (new User())->findById($userId);

    return $view->render($res, 'pages/profile/settings.twig', [
      'auth' => Auth::check(),
      'user' => $user
    ]); 
  }

  public function editSettings(Request $req, Response $res): Response 
  {
    $data = $req->getParsedBody();

    $userId = Session::getData('user');
    
    $user = new User();
    $user->update($data, $userId);

    return $res->withStatus(302)->withHeader('Location', '/profile/settings');
  }
}
