<?php

class DataBase
{
  private $host = "mysql-taskies.alwaysdata.net";
  private $dbname = "taskies_database";
  private $username = "taskies";
  private $pswd = "Mytasksprogram13";

  public function connect()
  {
    $dsn = 'mysql:host=' . $this->host . ';dbname=' . $this->dbname;
    $pdo = new PDO($dsn, $this->username, $this->pswd);
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    return $pdo;
  }
  
}

$database = new DataBase();

$connect = $database->connect();

