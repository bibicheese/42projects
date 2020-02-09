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
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    try {
      $conn->query("SELECT * FROM users LIMIT 1");
    }
    catch(PDOException $e) {
      $this->table_users($conn);
      $this->fill_table_users($conn);
    }

    try {
      $conn->query("SELECT * FROM tags LIMIT 1");
    }
    catch(PDOException $e) {
      $this->table_tags($conn);
      $this->fill_table_tags($conn);
    }

    try {
      $conn->query("SELECT * FROM images LIMIT 1");
    }
    catch(PDOException $e) {
      $this->table_images($conn);
    }

    try {
      $conn->query("SELECT * FROM viewers LIMIT 1");
    }
    catch(PDOException $e) {
      $this->table_viewers($conn);
    }

    try {
      $conn->query("SELECT * FROM likes LIMIT 1");
    }
    catch(PDOException $e) {
      $this->table_likes($conn);
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
                city VARCHAR(255) DEFAULT NULL,
                dept VARCHAR(2) DEFAULT NULL,
                region VARCHAR(255) DEFAULT NULL,
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
                profil INT DEFAULT 0,
                reg_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP)");
      }
      catch(PDOException $e) {
        echo "tags_table failed: " . $e->getMessage();
      }
  }


  private function table_viewers($db) {
    try {
      $db->query("CREATE TABLE IF NOT EXISTS viewers (
                  visitor INT NOT NULL,
                  host INT NOT NULL,
                  visit_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP)");
        }
        catch(PDOException $e) {
          echo "tags_table failed: " . $e->getMessage();
        }
  }


  private function table_likes($db) {
    try {
      $db->query("CREATE TABLE IF NOT EXISTS likes (
                  liker INT NOT NULL,
                  action VARCHAR(20) DEFAULT 'liked =>',
                  liked INT NOT NULL)");
        }
        catch(PDOException $e) {
          echo "tags_table failed: " . $e->getMessage();
        }
  }


  private function fill_table_users($db) {
    $file = fopen("../config/seed/USERS.CSV", "r");
    $cities = fopen("../config/seed/CITIES.CSV", "r");
    $i = 0;
    $j = 0;


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
    city=:city,
    dept=:dept,
    region=:region,
    bio=:bio;";

    while (! feof($file))
    {
      if ($j > 2)
        $j = 0;
      $ligne = explode(",", fgets($file));
      if ($i >= 200)
        $city = explode(",", fgets($cities));

      if ($ligne[0]) {
        $birth = trim($ligne[3], '"');
        $birth = explode('/', $birth);
        $age = (date("md", date("U", mktime(0, 0, 0, $birth[0], $birth[1], $birth[2])))
        > date("md") ?
        ((date("Y") - $birth[2]) - 1) : (date("Y") - $birth[2]));

        $orientation = [
          '0' => 'hetero',
          '1' => 'gay',
          '2' => 'bi'
        ];

        $row = [
          'active' => '1',
          'firstname' => $ligne[0],
          'lastname' => $ligne[1],
          'email' => $ligne[2],
          'birth' => $ligne[3],
          'age' => $age,
          'gender' => $ligne[4],
          'orientation' => $orientation[$j],
          'login' => $ligne[5],
          'password' => hash('whirlpool', $ligne[6]),
          'bio' => str_replace(["\n","\r"], "", $ligne[7]),
          'city' => $i < 200 ? "Paris" : $city[0],
          'dept' => $i < 200 ? "75" : $city[1],
          'region' => "Île-de-France"
        ];

        $db->prepare($sql)->execute($row);
        $i++;
        $j++;
      }
    }
    fclose($file);
    fclose($cities);
  }


  private function fill_table_tags($db) {
      $file = fopen("../config/seed/TAGS.CSV", "r");
      $sql = "SELECT count(*) FROM users";
      $ret = $db->query($sql)->fetchAll(PDO::FETCH_ASSOC);

      $i = $ret[0]['count(*)'];

      while ($i != 1) {
        if (feof($file)) {
          fclose($file);
          $file = fopen("../config/seed/TAGS.CSV", "r");
        }
        $ligne = fgets($file);
        if ($ligne) {
          $sql = "SELECT * FROM tags WHERE
          tag = '$ligne'";

          if ($ret = $db->query($sql)->fetch(PDO::FETCH_ASSOC)) {
            $row = [
              'userids' => $ret['userids'] . ',' . $i,
              'tag' => $ligne
            ];

            $sql = "UPDATE tags SET
            userids=:userids
            WHERE
            tag=:tag;";
          }
          else {
            $row = [
              'tag' => $ligne,
              'userids' => $i
            ];

            $sql = "INSERT INTO tags SET
            tag=:tag,
            userids=:userids;";
          }
          $db->prepare($sql)->execute($row);
          $i--;
        }
      }
      fclose($file);
  }
}

?>
