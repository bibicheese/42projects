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

    public function Displayer($user) {
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
      $sql = "SELECT link FROM images WHERE
      `userid` = '$id'
      AND
      `profil` = 1";
      if (! $profilPic = $this->connection->query($sql)->fetch(PDO::FETCH_ASSOC))
        $profilPic = "../src/images/default.png";

      $this->addViews($dataUser['id']);

      return [
        'firstname' => $dataUser['firstname'],
        'lastname' => $dataUser['lastname'],
        'birth' => $dataUser['birth'],
        'age' => $dataUser['age'],
        'genre' => $dataUser['gender'],
        'orientation' => $dataUser['orientation'],
        'bio' => $dataUser['bio'],
        'profilPic' => $profilPic
      ];

    }

    private function addViews($idVisited) {
      if ($idVisited != $this->sess_id) {
        $sql = "INSERT INTO viewers SET
        `visitor` = $this->sess_id,
        `host` = '$idVisited';";
        $this->connection->query($sql);
      }
    }
}
