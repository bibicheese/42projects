<?php

namespace Src\Domain\User\Repository;

use Src\Domain\User\Data\UserData;
use PDO;

class UserLikerRepository
{
  private $connection;

  public function __construct(PDO $connection) {
    $this->connection = $connection;
  }

    public function addLike(UserData $user, $id) {
      $login = $user->login;
      $row = [
        'login' => $login
      ];
      $sql = "SELECT id FROM users WHERE
      login=:login;";
      $idToLike = $this->connection->prepare($sql);
      $idToLike->execute($row);
      $idToLike = $idToLike->fetch(PDO::FETCH_ASSOC);
      $idToLike = $idToLike['id'];


      $row = [
        'liker' => $id,
        'liked' => $idToLike
      ];
      $sql = "SELECT * FROM likes WHERE
      liker=:liker
      AND
      liked=:liked;";
      $ret = $this->connection->prepare($sql);
      $ret->execute($row);

      if ($ret->fetch(PDO::FETCH_ASSOC)) {
        $sql = "DELETE FROM likes WHERE
        liker=:liker
        AND
        liked=:liked;";
        $result = "unliked";
      }
      else {
        $sql = "UPDATE users SET
        score = score - 2
        WHERE
        id = '$id'";
        $this->connection->query($sql);
        
        $sql = "INSERT INTO likes SET
        liker=:liker,
        liked=:liked;";
        $result = "liked";
      }
      $this->connection->prepare($sql)->execute($row);

      if ($result == "liked") {
        $sql = "UPDATE users SET
        score = score + 7
        WHERE
        id = '$id'
        AND
        id = '$idToLike'";
        $this->connection->query($sql);
        
        $row = [
          'liked' => $id,
          'liker' => $idToLike
        ];
        $sql = "SELECT * FROM likes WHERE
        liked=:liked
        AND
        liker=:liker;";
        $ret = $this->connection->prepare($sql);
        $ret->execute($row);

        if ($ret->fetch(PDO::FETCH_ASSOC))
          $result = "MATCH";
      }
      return $result;
    }
}
