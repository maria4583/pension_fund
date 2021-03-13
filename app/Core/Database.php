<?php

namespace Core;

use PDO;

class Database extends PDO
{
  public function __construct()
  {
    parent::__construct(config('DB_DSN'), config('DB_USER'), config('DB_PASSWORD'));
    parent::setAttribute(parent::ATTR_DEFAULT_FETCH_MODE, parent::FETCH_ASSOC);
    parent::setAttribute(parent::ATTR_ERRMODE, parent::ERRMODE_EXCEPTION);
  }  
}