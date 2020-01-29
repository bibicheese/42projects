<?php

namespace Src\Domain\User\Repository;

use Src\Domain\User\Data\UserData;
use PDO;

class UserCreatorRepository
{
    private $connection;

    public function __construct(PDO $connection) {
        $this->connection = $connection;
    }

    public function insertUser(UserData $user): string {
        $row = [
            'login' => $user->login,
            'password' => $user->password,
            'email' => $user->email,
        ];

        $sql = "INSERT INTO users SET
                login=:login,
                password=:password,
                email=:email;";

        $this->connection->prepare($sql)->execute($row);

        return "user created";
    }

    public function UserExist(UserData $user) {
      $data['login'] = $user->login;
      $data['email'] = $user->email;

      foreach ($data as $key => $value) {
        $sql = "SELECT * FROM users WHERE `$key` = '$value'";
        if ($ret = $this->connection->query($sql)->fetch(PDO::FETCH_ASSOC))
          return $key;
      }
      return NULL;
    }
}
