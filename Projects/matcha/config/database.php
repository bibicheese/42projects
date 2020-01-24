<?php

class db {
  private $host   = "localhost";
  private $dbname = "matcha_db";
  private $user   = "root";
  private $paswd  = "123456";
  private $driver = "mysql";

  public function connect() {
    $mysql_conn = "$this->driver:host=$this->host;dbname=$this->dbname";
    $conn = new PDO($mysql_conn, $this->user, $this->paswd);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $conn->query("use $this->dbname");
    return $conn;
  }
  public function create() {
    $mysql_conn = "$this->driver:host=$this->host";
    $conn = new PDO($mysql_conn, $this->user, $this->paswd);
    $conn->query("CREATE DATABASE IF NOT EXISTS $this->dbname");
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $conn->query("use $this->dbname");
    $this->table_users($conn);
    return $conn;
  }
  private function table_users($db) {
  try {
    $db->query("CREATE TABLE IF NOT EXISTS users (
                id INT UNIQUE AUTO_INCREMENT PRIMARY KEY,
                firstname VARCHAR(30) DEFAULT NULL,
                lastname VARCHAR(30) DEFAULT NULL,
                email VARCHAR(50) UNIQUE NOT NULL,
                birth VARCHAR(30) DEFAULT NULL,
                age INT DEFAULT 0,
                gender VARCHAR(30) DEFAULT NULL,
                orientation VARCHAR(30) DEFAULT 'bi',
                login VARCHAR(30) NOT NULL UNIQUE,
                password VARCHAR(255) NOT NULL,
                reg_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP)");
      }
      catch(PDOException $e) {
        echo "user_table failed: " . $e->getMessage();
      }
  }
}

?>
