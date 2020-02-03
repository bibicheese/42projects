<?php

class db {
  private $host   = "localhost";
  private $dbname = "matcha_db";
  private $user   = "root";
  private $paswd  = "123456";
  private $driver = "mysql";

  public function create() {
    $mysql_conn = "$this->driver:host=$this->host";
    $conn = new PDO($mysql_conn, $this->user, $this->paswd);
    $conn->query("CREATE DATABASE IF NOT EXISTS $this->dbname");
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $conn->query("use $this->dbname");
    $this->table_users($conn);
    $this->table_tags($conn);
    $this->table_images($conn);
    return $conn;
  }


  private function table_users($db) {
  try {
    $db->query("CREATE TABLE IF NOT EXISTS users (
                id INT UNIQUE AUTO_INCREMENT PRIMARY KEY,
                active INT DEFAULT 0,
                firstname VARCHAR(30) NOT NULL,
                lastname VARCHAR(30) NOT NULL,
                email VARCHAR(50) UNIQUE NOT NULL,
                birth VARCHAR(30) DEFAULT NULL,
                age INT DEFAULT 0,
                gender VARCHAR(30) DEFAULT NULL,
                orientation VARCHAR(30) DEFAULT 'bi',
                login VARCHAR(30) NOT NULL UNIQUE,
                password VARCHAR(255) NOT NULL,
                token VARCHAR(255) DEFAULT NULL,
                bio VARCHAR(255) DEFAULT NULL,
                reg_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP)");
      }
      catch(PDOException $e) {
        echo "user_table failed: " . $e->getMessage();
      }
  }


  private function table_tags($db) {
  try {
    $db->query("CREATE TABLE IF NOT EXISTS tags (
                id INT UNIQUE AUTO_INCREMENT PRIMARY KEY,
                tag VARCHAR(50) NOT NULL UNIQUE,
                userids VARCHAR(255) NOT NULL,
                reg_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP)");
      }
      catch(PDOException $e) {
        echo "tags_table failed: " . $e->getMessage();
      }
  }


  private function table_images($db) {
  try {
    $db->query("CREATE TABLE IF NOT EXISTS images (
                id INT UNIQUE AUTO_INCREMENT PRIMARY KEY,
                link VARCHAR(255) NOT NULL UNIQUE,
                userids INT NOT NULL,
                profil INT DEFAULT 0,
                reg_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP)");
      }
      catch(PDOException $e) {
        echo "tags_table failed: " . $e->getMessage();
      }
  }
}

?>
