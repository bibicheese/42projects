<?php

namespace Src\Domain\User\Repository;

use Src\Domain\User\Data\UserData;
use PDO;

class UserAccEditorRepository
{
    private $connection;

    public function __construct(PDO $connection) {
        $this->connection = $connection;
    }

    public function insertData(UserData $user, $id) {
      if ($user->birth) {
        $birth = $user->birth;
        $birth = explode('/', $birth);
        $age = (date("md", date("U", mktime(0, 0, 0, $birth[0], $birth[1], $birth[2])))
        > date("md") ?
        ((date("Y") - $birth[2]) - 1) :
        (date("Y") - $birth[2]));
      }

      $data = [
        'login' => $user->login,
        'password' => $user->password,
        'email' => $user->email,
        'firstname' => $user->firstname,
        'lastname' => $user->lastname,
        'orientaion' => $user->orientation,
        'gender' => $user->gender,
        'birth' => $user->birth,
        'bio' => $user->bio,
        'city' => $user->city,
        'arr' => $user->arr,
        'age' => $age
      ];

      foreach ($data as $key => $value) {
        if ($key == 'email' && $value == $email['email']) {
          unset($data[$key]);
        }
        if (!$value) {
          unset($data[$key]);
        }
        
      }

      $elm = count($data);
      $i = 0;
      foreach ($data as $key => $value) {
        $query = ++$i == $elm ? $query . "$key=:$key" : $query . "$key=:$key,";
      }

      $sql = "UPDATE users SET
      $query 
      WHERE
      id = '$id'";

      $this->connection->prepare($sql)->execute($data);
      return ['status' => 1, 'success' => 'OK boomer'];
    }


    public function UserExist(UserData $user, $id) {
      $data['login'] = $user->login;
      $data['email'] = $user->email;
      $password = $user->password;

      $sql = "SELECT email FROM users WHERE
      id = '$id'";
      $email = $this->connection->query($sql)->fetch(PDO::FETCH_ASSOC);

      foreach ($data as $key => $value) {
        $row = [
          $key => $value
        ];

        $sql = "SELECT * FROM users WHERE
        $key=:$key;";

        $ret = $this->connection->prepare($sql);
        $ret->execute($row);
        if ($ret = $ret->fetch(PDO::FETCH_ASSOC)) {
          if ($key == 'email' && $ret['email'] == $email['email'])
            echo "";
          else
            return $key . " taken";
        }
          
      }

      $row = [
        'id' => $id
      ];

      $sql = "SELECT * FROM users WHERE
      id=:id;";

      $ret = $this->connection->prepare($sql);
      $ret->execute($row);
      $ret = $ret->fetch(PDO::FETCH_ASSOC);
      if ($ret['password'] == $password)
        return "Le mot de passe doit être différent de l'ancien.";

      return NULL;
    }

    public function insertInterest($interest, $id) {
      foreach ($interest as $key => $value) {
        $row = [
          'tag' => $value
        ];

        $sql = "SELECT * FROM tags WHERE
        tag=:tag;";

        $ret = $this->connection->prepare($sql);
        $ret->execute($row);
        if ($ret = $ret->fetch(PDO::FETCH_ASSOC)) {
          $tag_ids = explode(',', $ret['userids']);

          if (in_array($id, $tag_ids))
            continue;
          else {
            $row = [
              'userids' => $ret['userids'] . ',' . $id,
              'tag' => $value
            ];

            $sql = "UPDATE tags SET
            userids=:userids
            WHERE
            tag=:tag;";

            $this->connection->prepare($sql)->execute($row);
          }
        }
        else {
          $row = [
            'tag' => $value,
            'userids' => $id
          ];

          $sql = "INSERT INTO tags SET
          tag=:tag,
          userids=:userids;";

          $this->connection->prepare($sql)->execute($row);
        }
      }
      $this->removeUserFromTag($interest, $id);
    }


    private function removeUserFromTag($interest, $id) {
      $ret = $this->connection->query("SELECT * FROM tags");
      $ret = $ret->fetchAll(PDO::FETCH_ASSOC);
      $rows = count($ret);
      $i = -1;

      while (++$i < $rows)
      {
        if (in_array($id, explode(',', $ret[$i]['userids']))) {
          if (!in_array($ret[$i]['tag'], $interest)) {
            if ($newids = $this->removeId($ret[$i]['userids'])) {
              $row = [
                'userids' => $newids,
                'id' => $ret[$i]['id']
              ];

              $sql = "UPDATE tags SET
              userids=:userids
              WHERE
              id=:id;";

              $this->connection->prepare($sql)->execute($row);
            }
            else {
              $row = [
                'id' => $ret[$i]['id']
              ];

              $sql = "DELETE FROM tags WHERE
              id=:id;";

              $this->connection->prepare($sql)->execute($row);
            }
          }
        }
      }
    }


    private function removeId($userids) {
      $userids = explode('.', $userids);
      $rows = count($userids);
      $i = 0;

      foreach ($userids as $key => $value) {
        if ($value != $id && $value)
          $newids = $i == 0 ? $newids . $value : $newids . '.' . $value;
        $i++;
      }

      if ($newids == '.')
        return NULL;
      return $newids;
    }


}
