<?php

namespace App\Middlewares;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Server\RequestHandlerInterface as RequestHandler;

use Core\Session;

class SessionMiddleware
{
  public function __invoke(Request $req, RequestHandler $handler): Response
  {
    Session::start();
    $res = $handler->handle($req);
    Session::save();

    return $res;
  }
}