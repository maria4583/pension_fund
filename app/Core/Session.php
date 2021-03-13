<?php

namespace Core;

class Session
{
  static public function start(): void 
  {
    session_start();
  }

  static public function save(): void
  {
    session_write_close();
  }

  static public function setData(string $key, $value): void
  {
    $_SESSION[$key] = $value;
  }

  static public function getData(string $key)
  {
    return !empty($_SESSION[$key]) ? $_SESSION[$key] : false;
  }
  
  static public function unset(string $key): void
  {
    unset($_SESSION[$key]);
  }
}