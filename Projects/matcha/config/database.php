<?php

class db {
  private $host   = "localhost";
  private $dbname = "matcha_db";
  private $user   = "root";
  private $paswd  = "123456";

  public function create() {
    $mysql_conn = "mysql:host=$this->host";
    $conn = new PDO($mysql_conn, $this->user, $this->paswd);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $conn->query("CREATE DATABASE IF NOT EXISTS $this->dbname");
    $conn->query("use $this->dbname");
    $this->table_users($conn);
    $this->test($conn);
    return $conn;
  }
  private function table_users($db) {
  try {
    $db->query("CREATE TABLE IF NOT EXISTS users (
                id INT UNIQUE AUTO_INCREMENT PRIMARY KEY,
                firstname VARCHAR(30) NOT NULL,
                lastname VARCHAR(30) NOT NULL,
                email VARCHAR(50) UNIQUE NOT NULL,
                birth VARCHAR(30) NOT NULL,
                age INT NOT NULL,
                gender VARCHAR(30) NOT NULL,
                orientation VARCHAR(30) NOT NULL,
                login VARCHAR(30) NOT NULL UNIQUE,
                password VARCHAR(255) NOT NULL,
                reg_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP)");
      }
      catch(PDOException $e) {
        echo "user_table failed: " . $e->getMessage();
      }
  }
  private function test($db) {
    try {
      $db->query("CREATE TABLE IF NOT EXISTS test (
                id int(11) NOT NULL AUTO_INCREMENT,
                username varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
                email varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
                first_name varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
                last_name varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
                PRIMARY KEY (id),
                UNIQUE KEY username (username))");
    }
    catch(PDOException $e) {
      echo "user_table failed: " . $e->getMessage();
    }
  }
}

?>
