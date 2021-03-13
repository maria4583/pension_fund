<?php

function config($key, $fallback = null) {
  $data = [
    'DB_DSN' => 'mysql:host=localhost;dbname=pension_fund',
    'DB_USER' => 'root',
    'DB_PASSWORD' => 'root'
  ];  

  return array_key_exists($key, $data) 
    ? $data[$key]
    : $fallback;
};