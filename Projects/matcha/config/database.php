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
                token_log VARCHAR(255) DEFAULT NULL,
                bio VARCHAR(255) DEFAULT NULL,
                score INT DEFAULT 50,
                views VARCHAR(255) DEFAULT NULL,
                city VARCHAR(255) DEFAULT NULL,
                arr CHAR(2) DEFAULT NULL,
                dept CHAR(2) DEFAULT NULL,
                ZIP VARCHAR(5) DEFAULT NULL,
                region VARCHAR(255) DEFAULT NULL,
                latitude VARCHAR(255) DEFAULT NULL,
                longitude VARCHAR(255) DEFAULT NULL,
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
                userids VARCHAR(1024) NOT NULL,
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
                  id INT UNIQUE AUTO_INCREMENT PRIMARY KEY,
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
                  id INT UNIQUE AUTO_INCREMENT PRIMARY KEY,
                  liker INT NOT NULL,
                  action VARCHAR(20) DEFAULT 'liked =>',
                  liked INT NOT NULL)");
        }
        catch(PDOException $e) {
          echo "tags_table failed: " . $e->getMessage();
        }
  }


  private function fill_table_users($db) {
    $fileUsers = fopen("../config/seed/USERS.CSV", "r");
    $filesIdf = fopen("../config/seed/CITIES.CSV", "r");
    $fileParis = fopen("../config/seed/PARIS.CSV", "r");
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
    bio=:bio,
    city=:city,
    arr=:arr,
    dept=:dept,
    ZIP=:ZIP,
    region=:region,
    latitude=:latitude,
    longitude=:longitude;";

    while (! feof($fileUsers))
    {
      if (feof($fileParis)) {
        fclose($fileParis);
        $fileParis = fopen("../config/seed/PARIS.CSV", "r");
      }

      $ligne = explode(",", fgets($fileUsers));
      if ($i >= 400)
        $idf = explode(",", fgets($filesIdf));
      else 
        $paris = explode(",", fgets($fileParis));

      if ($ligne[0]) {
        $birth = trim($ligne[3], '"');
        $birth = explode('/', $birth);
        $age = (date("md", date("U", mktime(0, 0, 0, $birth[0], $birth[1], $birth[2])))
        > date("md") ?
        ((date("Y") - $birth[2]) - 1) : (date("Y") - $birth[2]));

        $orientation = [
          '0' => 'Hétérosexuel',
          '1' => 'Homosexuel',
          '2' => 'Bisexuel'
        ];

        if ($j > 2)
          $j = 0;
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
          'city' => $i < 400 ? $paris[0] : $idf[0],
          'arr' => $i < 400 ? $paris[1] : NULL,
          'dept' => $i < 400 ? $paris[2] : $idf[1],
          'ZIP' => $i < 400 ? $paris[3] : $idf[2],
          'region' => "Île-de-France",
          'latitude' => $i < 400 ? $paris[4] : $idf[3],
          'longitude' => $i < 400 ? $paris[5] : $idf[4]
        ];

        $db->prepare($sql)->execute($row);
        $i++;
        $j++;
      }
    }
    fclose($fileUsers);
    fclose($filesIdf);
    fclose($fileParis);
  }


  private function fill_table_tags($db) {
      $file = fopen("../config/seed/TAGS.CSV", "r");
      $sql = "SELECT count(*) FROM users";
      $ret = $db->query($sql)->fetchAll(PDO::FETCH_ASSOC);

      $max = $ret[0]['count(*)'];
      $i = 0;
      while ($i++ != $max) {
        if (feof($file)) {
          fclose($file);
          $file = fopen("../config/seed/TAGS.CSV", "r");
        }
        $ligne = explode(',', fgets($file));
        if ($ligne[0]) {
          $j = 0;
          while ($j++ < 3) {
            $rand = rand(0, 50);
            $value = $ligne[$rand];
            $sql = "SELECT * FROM tags WHERE
            tag = '$value'";

            if ($ret = $db->query($sql)->fetch(PDO::FETCH_ASSOC)) {
              $userids = $ret['userids'];
              $regex = "/(,|^)$i(,|$)/";
              if (! preg_match($regex, $userids, $match)) {
                $row = [
                  'userids' => $ret['userids'] . ',' . $i,
                  'tag' => $value
                ];

                $sql = "UPDATE tags SET
                userids=:userids
                WHERE
                tag=:tag;";
                
                $db->prepare($sql)->execute($row);
              }
              else 
                $j--;
            }
            else {
              $row = [
                'tag' => $value,
                'userids' => $i
              ];

              $sql = "INSERT INTO tags SET
              tag=:tag,
              userids=:userids;";
              
              $db->prepare($sql)->execute($row);
            }
          }
        }
      }
      fclose($file);
  }

}
  

?>
