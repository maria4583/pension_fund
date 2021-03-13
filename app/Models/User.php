<?php

namespace App\Models;

use Core\Model;

class User extends Model
{
  public $name;
  public $surname;
  public $middle_name = null;
  public $email = null;
  public $phone;
  public $gender = null;
  public $birth = null;
  public $address = null;
  public $passport = null;
  public $snils = null;
  public $oms = null;
  public $inn = null;
  public $password;

  public function fields(): array
  {
    return [
      'name' => $this->name,
      'surname' => $this->surname,
      'middle_name' => $this->middle_name,
      'email' => $this->email,
      'phone' => $this->phone,
      'gender' => $this->gender,
      'birth' => $this->birth,
      'address' => $this->address,
      'passport' => $this->passport,
      'snils' => $this->snils,
      'oms' => $this->oms,
      'inn' => $this->inn,
      'password' => $this->password,
    ];
  }

  public function table(): string
  {
    return 'user';
  }
}