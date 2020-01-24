<?php

namespace Src\Domain\User\Service;

use Src\Domain\User\Data\UserData;


final class UserCreator
{
    private $connection;

    public function __construct() {
        require __DIR__ . '../../../../config/database.php';
        $db = new db;
        $db = $db->connect();
        $this->connection = $db;
    }

    public function createUser(UserData $user): int {
        $row = [
            'login' => $user->login,
            'password' => $user->password,
            'email' => $user->email
          ];

        $sql = "INSERT INTO test SET
                login=:login,
                password=:password,
                email=:email;
                ";

        $this->connection->prepare($sql)->execute($row);
        return (int)$this->connection->lastInsertId();
    }
}
