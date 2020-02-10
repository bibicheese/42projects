<?php

namespace Src\Domain\User\Repository;

use SlimSession\Helper;
use PDO;

class SelfProfilDisplayerRepository
{
    private $connection;

    public function __construct(PDO $connection, Helper $session) {
      $this->connection = $connection;
    }

    public function displayer($id) {
      $sql = "SELECT * FROM users WHERE
      id = '$id'";

      $ret = $this->connection->query($sql)->fetch(PDO::FETCH_ASSOC);

      $size = strlen($ret['password']);
      $crypted = str_repeat("*", $size);

      $sql = "SELECT link FROM images WHERE
      userid = '$id'
      AND
      profil = '1'";

      if (! $profilPic = $this->connection->query($sql)->fetch(PDO::FETCH_ASSOC))
        $profilPic = "../src/images/default.png";

      $sql = "SELECT link FROM images WHERE
      userid = '$id'
      AND
      profil = '0'";

      if (! $images = $this->connection->query($sql)->fetchAll(PDO::FETCH_ASSOC))
        $images = NULL;

      $sql = "SELECT tag FROM tags WHERE
      userids REGEXP '(,|^)$id(,|$)'";

      $tags_db = $this->connection->query($sql)->fetchAll(PDO::FETCH_ASSOC);

      $j = count($tags_db);
      while ($j-- != 0)
        $tags = !$tags ? $tags_db[$j]['tag'] : $tags . "," . $tags_db[$j]['tag'];

      $sql = "SELECT * FROM viewers WHERE
      host = '$id'";

      if (! $views = $this->connection->query($sql)->fetchAll(PDO::FETCH_ASSOC))
        $views = NULL;
      else {
        $i = count($views);
        while ($i-- != 0)
          echo $views[$i]['visitor'] . "\n";
      }
      
      return [
        'firstname' => $ret['firstname'],
        'lastname' => $ret['lastname'],
        'email' => $ret['email'],
        'birth' => $ret['birth'],
        'age' => $ret['age'],
        'genre' => $ret['gender'],
        'orientation' => $ret['orientation'],
        'login' => $ret['login'],
        'password' => $crypted,
        'bio' => $ret['bio'],
        'city' => $ret['city'],
        'dept' => $ret['dept'],
        'region' => $ret['region'],
        'reg_date' => $ret['reg_date'],
        'profilPic' => $profilPic,
        'images' => $images,
        'tags' => $tags,
        'views historique' => $views,
        // 'liked by' =>
      ];
    }
}
