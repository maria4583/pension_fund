<?php

namespace App\Models;

use Core\Model;

class Order extends Model
{
  public $user_id;
  public $service_id;
  public $date;
  public $status;

  public function fields(): array 
  {
    return [
      'user_id' => $this->user_id,
      'service_id' => $this->service_id,
      'date' => $this->date,
      'status' => $this->status
    ];
  }

  public function table(): string 
  {
    return 'order';
  }
}