<?php

namespace Src\Domain\User\Repository;

use SlimSession\Helper;
use Src\Domain\User\Data\UserData;
use PDO;

class ProfilDisplayerRepository
{
    private $connection;
    private $session;
    private $sess_id;

    public function __construct(PDO $connection, Helper $session) {
      $this->connection = $connection;
      $this->session = $session;
      $this->sess_id = $session['id'];
    }

    public function displayer($user) {
      $login = $user->login;

      $row = [
        'login' => $login
      ];

      $sql = "SELECT * FROM users WHERE
      login=:login;";

      $ret = $this->connection->prepare($sql);
      $ret->execute($row);
      if (! $dataUser = $ret->fetch(PDO::FETCH_ASSOC))
        return ['error' => 'user do not exist'];

      $id = $dataUser['id'];

      $this->addViews($id);

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
      if (! $images = $this->connection->query($sql)->fetch(PDO::FETCH_ASSOC))
        $images = NULL;

      $sql = "SELECT tag FROM tags WHERE
      userids REGEXP '(,|^)$id(,|$)'";
      $tags_db = $this->connection->query($sql)->fetchAll(PDO::FETCH_ASSOC);

      $j = count($tags_db);
      while ($j-- != 0)
        $tags = !$tags ? $tags_db[$j]['tag'] : $tags . "," . $tags_db[$j]['tag'];

      return [
        'firstname' => $dataUser['firstname'],
        'lastname' => $dataUser['lastname'],
        'birth' => $dataUser['birth'],
        'age' => $dataUser['age'],
        'genre' => $dataUser['gender'],
        'orientation' => $dataUser['orientation'],
        'bio' => $dataUser['bio'],
        'profilPic' => $profilPic['link'],
        'images' => $images,
        'tags' => $tags
      ];

    }

    private function addViews($idVisited) {
      if ($idVisited != $this->sess_id) {
        $sql = "INSERT INTO viewers SET
        `visitor` = $this->sess_id,
        `host` = '$idVisited';";
        $this->connection->query($sql);
      }
      else
        header("location: 127.0.0.1/my_profil");
    }
}
