<?php

namespace Src\Domain\User\Repository;

use Src\Domain\User\Data\UserCreateData;
use PDO;

class UserCreatorRepository
{
    private $connection;

    public function __construct(PDO $connection) {
        $this->connection = $connection;
    }

    public function insertUser(UserCreateData $user): array {
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

        return array('success' => 'user created');
        // return (int)$this->connection->lastInsertId();
    }

    public function UserExist(UserCreateData $user) {
      $data['login'] = $user->login;
      $data['email'] = $user->email;

      foreach ($data as $key => $value) {
        $sql = "SELECT * FROM users WHERE `$key` = '$value'";
        if ($ret = $this->connection->query($sql)->fetch(PDO::FETCH_ASSOC))
          return $key;
      }
    }
}
