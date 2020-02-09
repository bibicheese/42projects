<?php

namespace Src\Domain\User\Repository;

use PDO;

class ListSuggesterRepository
{
    private $connection;

    public function __construct(PDO $connection) {
        $this->connection = $connection;
    }

    public function infoComplete($id) {
        $sql = "SELECT * FROM users WHERE
        `id` = '$id';";
        $ret = $this->connection->query($sql)->fetch(PDO::FETCH_ASSOC);

        foreach ($ret as $key => $value) {
          if (! $value && $key == 'firstname' ||
              ! $value && $key == 'lastname' ||
              ! $value && $key == 'email' ||
              ! $value && $key == 'birth' ||
              ! $value && $key == 'gender' ||
              ! $value && $key == 'orientation' ||
              ! $value && $key == 'login' ||
              ! $value && $key == 'password' ||
              ! $value && $key == 'bio')
              return 'must complete profil first';
        }
    }


    public function displayList($id) {
        $sql = "SELECT * FROM users WHERE
        `id` = '$id'";
        $user = $this->connection->query($sql)->fetch(PDO::FETCH_ASSOC);

        $mine = "%\,$id\,%";
        $sql = "SELECT * FROM tags WHERE
        userids LIKE '$mine'";
        $tags = $this->connection->query($sql)->fetchAll(PDO::FETCH_ASSOC);

        return $tags;
        $ageUp = $user['age'] + 3;
        $ageDown = $user['age'] - 3;
        $select = "firstname,
                  lastname,
                  age,
                  gender,
                  orientation,
                  city,
                  bio";

        if ($user['orientation'] != 'bi') {
          $gender = $this->getGender($user['orientation'], $user['gender']);
          $orientation = $user['orientation'];
          $city = $user['city'];

          $sql = "SELECT $select FROM users WHERE
          gender = '$gender'
          AND
          orientation = '$orientation'
          AND
          city = '$city'
          AND
          age BETWEEN $ageDown AND $ageUp;";
        }
        else {
          $gender = 'male';
          $genderOr = 'female';
          $orientationBase = 'bi';
          $orientation = $user['gender'] == 'male' ? 'gay' : 'hetero';
          $orientationOr = $user['gender'] == 'male' ? 'hetero' : 'gay';
          $city = $user['city'];

          $sql = "SELECT $select FROM users WHERE
          gender = '$gender'
          AND
          orientation = '$orientation'
          AND
          city = '$city'
          AND
          age BETWEEN $ageDown AND $ageUp
          UNION
          SELECT $select FROM users WHERE
          gender = '$genderOr'
          AND
          orientation = '$orientationOr'
          AND
          city = '$city'
          AND
          age BETWEEN $ageDown AND $ageUp
          UNION
          SELECT $select FROM users WHERE
          orientation = '$orientationBase'
          AND
          city = '$city'
          AND
          age BETWEEN $ageDown AND $ageUp;";
        }
        return $this->connection->query($sql)->fetchAll(PDO::FETCH_ASSOC);
    }

    private function getGender($orientation, $gender) {
      if ($orientation == 'gay') {
        if ($gender == 'male')
          return 'male';
        else
          return 'female';
      }
      elseif ($orientation == 'hetero') {
        if ($gender == 'male')
          return 'female';
        else
          return 'male';
      }
    }
}
