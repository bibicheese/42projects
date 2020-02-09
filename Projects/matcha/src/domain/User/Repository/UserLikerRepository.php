<?php

namespace Src\Domain\User\Repository;

use SlimSession\Helper;
use Src\Domain\User\Data\UserData;
use PDO;

class UserLikerRepository
{
  private $connection;
  private $session;
  private $sess_id;

  public function __construct(PDO $connection, Helper $session) {
    $this->connection = $connection;
    $this->session = $session;
    $this->sess_id = $session['id'];
  }

    public function addLike(UserData $user) {
      $login = $user->login;

      $row = [
        'login' => $login
      ];

      $sql = "SELECT id FROM users WHERE
      login=:login;";

      $idToLike = $this->connection->prepare($sql);
      $idToLike->execute($row);
      $idToLike = $idToLike->fetch(PDO::FETCH_ASSOC);

      $row = [
        'liker' => $this->sess_id,
        'liked' => $idToLike['id']
      ];

      $sql = "INSERT INTO likes SET
      liker=:liker,
      liked=:liked;";

      $this->connection->prepare($sql)->execute($row);
    }
}
