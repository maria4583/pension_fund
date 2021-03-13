<?php

namespace Core;

use Core\Database;

abstract class Model
{
  private $db;

  public function __construct() 
  {
    $this->db = new Database();
  }

  abstract public function fields();

  abstract public function table();

  public function select(string $sql, array $data = [])
  {
    $stmt = $this->db->prepare($sql);
    $stmt->execute($data);

    return $stmt->fetchAll();
  }

  public function findById($id)
  {
    $table = $this->table();
    
    $stmt = $this->db->prepare("SELECT * FROM `$table` WHERE id = $id");
    $stmt->execute();
    
    return $stmt->fetch();
  }

  public function findWithParams(string $where, array $data = [])
  {
    $table = $this->table();

    $stmt = $this->db->prepare("SELECT * FROM `$table` WHERE " . $where);
    $stmt->execute($data);

    return $stmt->fetch();
  }

  public function totalCount(string $where = ""): int
  {
    $table = $this->table();

    $stmt = $this->db->prepare("SELECT COUNT(*) FROM `$table`" . $where);
    $stmt->execute();

    return (int) $stmt->fetchColumn() ?? 0;
  }

  public function findAll()
  {
    $table = $this->table();

    $stmt = $this->db->prepare("SELECT * FROM `$table`");
    $stmt->execute();

    return $stmt->fetchAll();
  }

  public function save(): bool
  {
    $table = $this->table();
    $fields = $this->fields();

    $arrayForSet = [];

    foreach($fields as $key => $value) {
      if (!empty($value)) {
        $arrayForSet[$key] = $value; 
      }
    }

    $forQueryFields = implode(', ', array_keys($arrayForSet));
    $fillFields = array_fill(0, count($arrayForSet), '?');
    $forQueryValues = implode(', ', $fillFields);

    $stmt = $this->db->prepare("INSERT INTO `$table` ($forQueryFields) VALUES ($forQueryValues)");
    $stmt->execute(array_values($arrayForSet));

    return true;
  }

  public function update(array $data, int $id): bool
  {
    $table = $this->table();
    $formatDataArray = [];

    foreach($data as $key => $value) {
      $formatDataArray[] = $key . ' = "' . $value . '"';
    }

    $formatDataStr = implode(', ', $formatDataArray);

    $stmt = $this->db->prepare("UPDATE `$table` SET $formatDataStr WHERE id = $id");
    $stmt->execute();

    return true;
  }
}