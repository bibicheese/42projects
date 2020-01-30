<?php

namespace Src\Domain\User\Repository;

use SlimSession\Helper;
use Src\Domain\User\Data\UserData;
use PDO;

class UserAccEditorRepository
{
    private $connection;
    private $session;
    private $sess_id;

    public function __construct(PDO $connection, Helper $session) {
        $this->connection = $connection;
        $this->session = $session;
        $this->sess_id = $session['id'];
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

      $sql = "UPDATE users SET $query WHERE `id` = '$this->sess_id'";

      $this->connection->prepare($sql)->execute($data);
      return "data has been modified";
    }

    public function UserExist(UserData $user) {
      $data['login'] = $user->login;
      $data['email'] = $user->email;
      $password = $user->password;

      foreach ($data as $key => $value) {
        $sql = "SELECT * FROM users WHERE `$key` = '$value'";
        if ($ret = $this->connection->query($sql)->fetch(PDO::FETCH_ASSOC))
          return $key . " taken";
      }
      $sql = "SELECT * FROM users WHERE `id` = '$this->sess_id'";

      $ret = $this->connection->query($sql)->fetch(PDO::FETCH_ASSOC);
      if ($ret['password'] == $password)
        return "password same";

      return NULL;
    }
}
