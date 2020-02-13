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
        id = '$id';";
        $userData = $this->connection->query($sql)->fetch(PDO::FETCH_ASSOC);

        $sql = "SELECT link FROM images WHERE
        userid = '$id'
        AND
        profil = '1'";
        if (! $profilPic = $this->connection->query($sql)->fetch(PDO::FETCH_ASSOC))
          // return 'must complete profil first';

        foreach ($userData as $key => $value) {
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
        id = '$id'";
        $user = $this->connection->query($sql)->fetch(PDO::FETCH_ASSOC);

        $sql = "SELECT * FROM tags WHERE
        userids REGEXP '(,|^)$id(,|$)'";
        $MyTags_db = $this->connection->query($sql)->fetchAll(PDO::FETCH_ASSOC);
        
        $i = count($MyTags_db);
        while ($i-- != 0)
        {
          $MyTags = !$MyTags ? $MyTags_db[$i]['tag'] :
                               $MyTags . "," . $MyTags_db[$i]['tag'];
        }
        $MyTags = explode(',', $MyTags);
        $select = "firstname,
                  lastname,
                  age,
                  gender,
                  orientation,
                  city,
                  bio,
                  id,
                  login";
        if ($user['orientation'] != 'Bisexuel') {
          $gender = $this->getGender($user['orientation'], $user['gender']);
          $orientation = $user['orientation'];
          $orientationOr = 'Bisexuel';

          $sql = "SELECT $select FROM users WHERE
          id != '$id'
          AND
          gender = '$gender'
          AND
          orientation = '$orientation'
          UNION
          SELECT $select FROM users WHERE
          id != '$id'
          AND
          gender = '$gender'
          AND
          orientation = '$orientationOr';";

        }
        else {
          $gender = 'Male';
          $genderOr = 'Female';
          $orientationBase = 'Bisexuel';
          $orientation = $user['gender'] == 'male' ? 'Homosexuel' : 'Hétérosexuel';
          $orientationOr = $user['gender'] == 'male' ? 'Hétérosexuel' : 'Homosexuel';
          $city = $user['city'];

          $sql = "SELECT $select FROM users WHERE
          id != '$id'
          AND
          gender = '$gender'
          AND
          orientation = '$orientation'
          UNION
          SELECT $select FROM users WHERE
          id != $id
          AND
          gender = '$genderOr'
          AND
          orientation = '$orientationOr'
          UNION
          SELECT $select FROM users WHERE
          id != '$id'
          AND
          orientation = '$orientationBase';";

        }
        
        $ret = $this->connection->query($sql)->fetchAll(PDO::FETCH_ASSOC);
        $i = 0;
        foreach ($ret as $key => $value) {
          $id = $ret[$i]['id'];
          $gender = $ret[$i]['gender'];

          $sql = "SELECT tag FROM tags WHERE
          userids REGEXP '(,|^)$id(,|$)'";
          $userTags = $this->connection->query($sql)->fetchAll(PDO::FETCH_ASSOC);
          $j = count($userTags);
          while ($j-- != 0) {
              $tags = !$tags ? $userTags[$j]['tag'] : $tags . "," . $userTags[$j]['tag'];
          }

          $sql = "SELECT link FROM images WHERE
          userid = '$id'
          AND
          profil = '1'";
          if (! $profilPic = $this->connection->query($sql)->fetch(PDO::FETCH_ASSOC)) {
              if ($gender == 'Male')
                $profilPic['link'] = "/img/male.jpg";
              elseif ($gender == 'Female')
                $profilPic['link'] = "/img/female.jpg";
          }

          $tags = explode(',', $tags);
          $ret[$i][tags] = $tags;
          $ret[$i][profilePic] = $profilPic['link'];
          $i++;
          $tags = NULL;
        }
        return $ret;
    }

    private function getGender($orientation, $gender) {
      if ($orientation == 'Homosexuel') {
        if ($gender == 'Male')
          return 'Male';
        else
          return 'Female';
      }
      elseif ($orientation == 'Hétérosexuel') {
        if ($gender == 'Male')
          return 'Female';
        else
          return 'Male';
      }
    }
}
