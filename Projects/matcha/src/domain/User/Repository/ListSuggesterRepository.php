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
          $matchTagsIds = !$matchTagsIds ? $MyTags_db[$i]['userids'] :
                                           $matchTagsIds . "," . $MyTags_db[$i]['userids'];
        }
        $MyTags = explode(',', $MyTags);
        $ageUp = $user['age'] + 3;
        $ageDown = $user['age'] - 3;
        $select = "firstname,
                  lastname,
                  age,
                  gender,
                  orientation,
                  city,
                  bio,
                  id,
                  login";

        if ($user['orientation'] != 'bi') {
          $gender = $this->getGender($user['orientation'], $user['gender']);
          $orientation = $user['orientation'];
          $orientationOr = 'bi';
          $city = $user['city'];

          $sql = "SELECT $select FROM users WHERE
          id != '$id'
          AND
          id IN ($matchTagsIds)
          AND
          gender = '$gender'
          AND
          orientation = '$orientation'
          AND
          city = '$city'
          AND
          age BETWEEN $ageDown AND $ageUp
          UNION
          SELECT $select FROM users WHERE
          id != '$id'
          AND
          id IN ($matchTagsIds)
          AND
          gender = '$gender'
          AND
          orientation = '$orientationOr'
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
          id != '$id'
          AND
          id IN ($matchTagsIds)
          AND
          gender = '$gender'
          AND
          orientation = '$orientation'
          AND
          city = '$city'
          AND
          age BETWEEN $ageDown AND $ageUp
          UNION
          SELECT $select FROM users WHERE
          id != $id
          AND
          id IN ($matchTagsIds)
          AND
          gender = '$genderOr'
          AND
          orientation = '$orientationOr'
          AND
          city = '$city'
          AND
          age BETWEEN $ageDown AND $ageUp
          UNION
          SELECT $select FROM users WHERE
          id != '$id'
          AND
          id IN ($matchTagsIds)
          AND
          orientation = '$orientationBase'
          AND
          city = '$city'
          AND
          age BETWEEN $ageDown AND $ageUp;";
        }
        $ret = $this->connection->query($sql)->fetchAll(PDO::FETCH_ASSOC);
        $i = 0;
        foreach ($ret as $key => $value) {
          $id = $ret[$i]['id'];

          $sql = "SELECT tag FROM tags WHERE
          userids REGEXP '(,|^)$id(,|$)'";
          $userTags = $this->connection->query($sql)->fetchAll(PDO::FETCH_ASSOC);

          $sql = "SELECT link FROM images WHERE
          userid = '$id'
          AND
          profil = '1'";
          if (! $profilPic = $this->connection->query($sql)->fetch(PDO::FETCH_ASSOC))
            $profilPic['link'] = "../src/images/default.png";

          $j = count($userTags);
          while ($j-- != 0) {
            if (!$tags && in_array($userTags[$j]['tag'], $MyTags))
              $tags = $userTags[$j]['tag'];
            else {
              if (in_array($userTags[$j]['tag'], $MyTags))
                $tags = $tags . "," . $userTags[$j]['tag'];
            }
          }
          $ret[$i][tags] = $tags;
          $ret[$i][profil] = $profilPic['link'];
          $i++;
          $tags = NULL;
        }
        return $ret;
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
