<?php

namespace Src\Domain\User\Repository;

use Src\Domain\User\Data\UserloginData;
use PDO;

class UserLoggerRepository
{
    private $connection;

    public function __construct(PDO $connection) {
        $this->connection = $connection;
    }

    public function indentifyUser(UserLoginData $user): int {
      $login = $user->login;
      $password = $user->password;

      $sql = "SELECT * FROM users WHERE `login` = '$login' AND `password` = '$password'";

      if ($ret = $this->connection->query($sql)->fetch(PDO::FETCH_ASSOC))
          return $ret['id'];
      else
        return -1;
    }
}
