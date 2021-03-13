<?php

namespace App\Models;

use Core\Model;

class Service extends Model
{
  public $title;
  public $description;
  public $documents;
  public $icon;
  public $price;

  public function fields(): array
  {
    return [
      'title' => $this->title, 
      'description' => $this->description,
      'documents' => $this->documents,
      'icon' => $this->icon,
      'price' => $this->price
    ];
  }

  public function table(): string
  {
    return 'service';
  }
}