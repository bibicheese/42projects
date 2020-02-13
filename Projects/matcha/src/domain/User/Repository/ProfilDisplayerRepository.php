<?php

namespace Src\Domain\User\Repository;

use Src\Domain\User\Data\UserData;
use PDO;

class ProfilDisplayerRepository
{
    private $connection;

    public function __construct(PDO $connection) {
      $this->connection = $connection;
    }

    public function displayer($user, $currId) {
      $login = $user->login;

      $row = [
        'login' => $login
      ];
      
      $sql = "SELECT * FROM users WHERE
      login=:login;";
      
      $ret = $this->connection->prepare($sql);
      $ret->execute($row);
      if (! $dataUser = $ret->fetch(PDO::FETCH_ASSOC))
        return [
          'status' => 0,
          'error' => [
            'user do not exist'
          ]
        ];
      
      $gender = $dataUser['gender'];
      $id = $dataUser['id'];
      
      $this->addViews($id, $currId);
      
      $sql = "SELECT link FROM images WHERE
      userid = '$id'
      AND
      profil = '1'";
      if (! $profilPic = $this->connection->query($sql)->fetch(PDO::FETCH_ASSOC)) {
          if ($gender == 'Male')
            $profilPic = "/img/male.jpg";
          elseif ($gender == 'Female')
            $profilPic = "/img/female.jpg";
      }
      
      $sql = "SELECT link FROM images WHERE
      userid = '$id'
      AND
      profil = '0'";
      if (! $images = $this->connection->query($sql)->fetch(PDO::FETCH_ASSOC))
        $images = [];
      
      $sql = "SELECT tag FROM tags WHERE
      userids REGEXP '(,|^)$id(,|$)'";
      $tags_db = $this->connection->query($sql)->fetchAll(PDO::FETCH_ASSOC);
      
      $j = count($tags_db);
      while ($j-- != 0)
        $tags = !$tags ? $tags_db[$j]['tag'] : $tags . "," . $tags_db[$j]['tag'];
      
      $tags = explode(',', $tags);
      return [
        'status' => 1,
        'success' => [
          'firstname' => $dataUser['firstname'],
          'lastname' => $dataUser['lastname'],
          'birth' => $dataUser['birth'],
          'age' => $dataUser['age'],
          'gender' => $dataUser['gender'],
          'orientation' => $dataUser['orientation'],
          'bio' => $dataUser['bio'],
          'profilePic' => $profilPic,
          'images' => $images,
          'city' => $dataUser['city'],
          'arr' => $dataUser['arr'],
          'tags' => $tags
        ]
      ];

    }

    private function addViews($idVisited, $currId) {
      if ($idVisited != $currId) {
        $sql = "INSERT INTO viewers SET
        visitor = '$currId',
        host = '$idVisited'";
        $this->connection->query($sql);
    
        $sql = "UPDATE users SET
        score = score + 2
        WHERE
        id = '$idVisited'";
        $this->connection->query($sql);
        
        $sql = "UPDATE users SET
        score = score - 1
        WHERE
        id = '$currId'";
        $this->connection->query($sql);
      }
      else
        header("location: 127.0.0.1/my_profil");
    }
}
