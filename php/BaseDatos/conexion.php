<?php

$host = 'localhost';
$database = 'mydb';
$user = 'root';
$password = '';

try {
  $db = new PDO("mysql:host=$host;dbname=$database", $user, $password);
}catch (PDOException $e) {
  echo $e->getMessage();
  exit(); 
}