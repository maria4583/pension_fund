<?php

namespace App\Controllers;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Views\Twig;
use App\Services\Auth;
use App\Models\Order;

class OrdersController
{
  private const ORDERS_PER_PAGE = 6;

  public function getOrders(Request $req, Response $res, array $args): Response
  {
    $view = Twig::fromRequest($req);

    $currentPage = (int) ($args['page'] ?? 1);
    $limit = self::ORDERS_PER_PAGE;
    $offset = ($currentPage - 1) * $limit;

    $userId = Auth::user();
    $sql = "
      SELECT `service`.`icon`, `service`.`title`, `order`.`date`, `order`.`status`
      FROM `order`
      JOIN `service`
      ON `service`.`id` = `order`.`service_id`
      WHERE `order`.`user_id` = $userId
      ORDER BY `order`.`date` DESC
      LIMIT $offset, $limit
    ";
    $model = new Order();
    $orders = $model->select($sql);
    $ordersCount = $model->totalCount(" WHERE user_id = $userId");

    $pages = ceil($ordersCount / $limit);

    return $view->render($res, 'pages/profile/orders.twig', [
      'auth' => Auth::check(),
      'orders' => $orders,
      'pagination' => [
        'total' => $pages,
        'current' => $currentPage,
      ],
    ]);
  }
}
