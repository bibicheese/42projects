<?php

namespace Src\Domain\User\Repository;

use SlimSession\Helper;
use Src\Domain\User\Data\UserData;
use PDO;

class UserAccEditorRepository
{
    private $connection;

    public function __construct(PDO $connection) {
        $this->connection = $connection;
    }

    public function insertData(UserData $user) {
      $data = [
        'login' => $user->login,
        'password' => $user->password,
        'email' => $user->email,
        'first name' => $user->firstName,
        'last name' => $user->lastName,
        'orientaion' => $user->orientation,
        'gender' => $user->gender,
        'birth' => $user->birth,
      ];

      foreach ($data as $key => $value) {
        if (!$value)
          unset($data[$key]);
      }

      $elm = count($data);
      $i = 0;
      foreach ($data as $key => $value) {
        $query = ++$i == $elm ? $query . "$key=:$key" : $query . "$key=:$key,";
      }

      $session = new Helper();
      $id = $session['id'];

      $sql = "UPDATE users SET $query WHERE `id` = $id";

      $this->connection->prepare($sql)->execute($data);
      return "data has been modified";
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
