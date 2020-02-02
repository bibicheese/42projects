<?php

namespace Src\Domain\User\Repository;

use Src\Domain\User\Data\UserData;
use PDO;

class UserLoggerRepository
{
    private $connection;

    public function __construct(PDO $connection) {
        $this->connection = $connection;
    }

    public function indentifyUser(UserData $user) {
      $login = $user->login;
      $password = $user->password;

      $row = [
        'login' => $login
      ];

      $sql = "SELECT * FROM users WHERE
      login=:login;";

      $ret = $this->connection->prepare($sql);
      $ret->execute($row);
      if (!$ret = $ret->fetch(PDO::FETCH_ASSOC))
        return "login";

      else if ($ret['password'] != $password)
        return "password";

      else if ($ret['active'] == 0)
        return "active";

      else
        return $ret['id'];
    }
}
