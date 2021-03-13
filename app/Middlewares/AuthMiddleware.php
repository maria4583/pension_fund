<?php

namespace App\Middlewares;

use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Server\RequestHandlerInterface as RequestHandler;
use Slim\Psr7\Response;

use App\Services\Auth;

class AuthMiddleware
{
  public function __invoke(Request $req, RequestHandler $handler): Response
  {
    if (!Auth::check()) {
      $res = new Response();
      return $res->withStatus(302)->withHeader('Location', '/auth/login');
    }
      
    $res = $handler->handle($req);
    return $res;
  }
}