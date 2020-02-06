<?php

class db {
  private $host   = "localhost";
  private $dbname = "matcha_db";
  private $user   = "root";
  private $paswd  = "123456";
  private $driver = "mysql";

  public function create() {
    $mysql_conn = "$this->driver:host=$this->host";
    $conn = new PDO($mysql_conn, $this->user, $this->paswd, array(PDO::MYSQL_ATTR_LOCAL_INFILE => true));
    $conn->query("CREATE DATABASE IF NOT EXISTS $this->dbname");
    $conn->query("use $this->dbname");

    if (! $conn->query("SELECT * FROM users LIMIT 1")) {
      $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      $this->table_users($conn);
      $this->table_tags($conn);
      $this->table_images($conn);
      $this->table_location($conn);
      $this->fill_table_users($conn);
      $this->fill_table_location($conn);
    }
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
                views VARCHAR(255) DEFAULT NULL,
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
                userid INT NOT NULL,
                profile INT DEFAULT 0,
                reg_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP)");
      }
      catch(PDOException $e) {
        echo "tags_table failed: " . $e->getMessage();
      }
  }


  private function table_location($db) {
  try {
    $db->query("CREATE TABLE IF NOT EXISTS location (
                ip_from INT(10) UNSIGNED DEFAULT 0,
                ip_to INT(10) UNSIGNED DEFAULT 0,
                country_code CHAR(2) DEFAULT NULL,
                country_name VARCHAR(64) DEFAULT NULL,
                region_name VARCHAR(128) DEFAULT NULL,
                city_name VARCHAR(128) DEFAULT NULL,
                latitude DOUBLE DEFAULT 0.000000,
                longitude DOUBLE DEFAULT 0.000000,
                zip VARCHAR(15) DEFAULT NULL)");
      }
      catch(PDOException $e) {
        echo "tags_table failed: " . $e->getMessage();
      }
  }


  private function fill_table_users($db) {
    $file = fopen("../config/seed/USERS.CSV", "r");

    $sql = "INSERT INTO users SET
    active=:active,
    firstname=:firstname,
    lastname=:lastname,
    email=:email,
    birth=:birth,
    age=:age,
    gender=:gender,
    orientation=:orientation,
    login=:login,
    password=:password,
    bio=:bio;";

    while (! feof($file))
    {
      $ligne = explode(",", fgets($file));
      if ($ligne[0]) {
        $birth = trim($ligne[3], '"');
        $birth = explode('/', $birth);
        $age = (date("md", date("U", mktime(0, 0, 0, $birth[0], $birth[1], $birth[2])))
        > date("md") ?
        ((date("Y") - $birth[2]) - 1) : (date("Y") - $birth[2]));

        $row = [
          'active' => '1',
          'firstname' => trim($ligne[0], '"'),
          'lastname' => trim($ligne[1], '"'),
          'email' => trim($ligne[2], '"'),
          'birth' => trim($ligne[3], '"'),
          'age' => $age,
          'gender' => trim($ligne[4], '"'),
          'orientation' => trim($ligne[5], '"'),
          'login' => trim($ligne[6], '"'),
          'password' => hash('whirlpool', trim($ligne[7], '"')),
          'bio' => trim(str_replace(["\n","\r"],"", $ligne[8]), '"')
        ];

        $db->prepare($sql)->execute($row);
      }
    }
    fclose($file);
  }


  private function fill_table_location($db) {
    try {
      $sql = "LOAD DATA LOCAL INFILE '../config/seed/IPLOCATION.CSV'
                  INTO TABLE location
                  FIELDS TERMINATED BY ',' ENCLOSED BY '\"'
                  LINES TERMINATED BY '\r\n'
                  IGNORE 0 LINES;";
        $db->prepare($sql)->execute();
    }
    catch(PDOException $e) {
      echo $e->getMessage();
    }
  }
}

?>
