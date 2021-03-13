<?php

namespace App\Services;

use Core\Session;
use App\Models\User;

class Auth
{
  static public function login(array $data): bool
  {
    $model = new User();
    $user = $model->findWithParams("email = :login or phone = :login", [
      'login' => $data['login']
    ]);

    if ($user && password_verify($data['password'], $user['password'])) {
      Session::setData('user', $user['id']);

      return true;
    } 

    return false;
  }

  static public function logout(): void
  {
    Session::unset('user');
  }

  static public function check(): bool
  {
    return !!Session::getData('user');
  }

  static public function user()
  {
    return Session::getData('user') ? Session::getData('user') : [];
  }
}