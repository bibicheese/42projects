<?php

namespace Src\Domain\User\Repository;

use SlimSession\Helper;
use PDO;

class SelfProfilDisplayerRepository
{
    private $connection;

    public function __construct(PDO $connection, Helper $session) {
      $this->connection = $connection;
    }


    public function displayer($id) {
      $sql = "SELECT * FROM users WHERE
      id = '$id'";
      $user = $this->connection->query($sql)->fetch(PDO::FETCH_ASSOC);
      $size = strlen($user['password']);
      $crypted = str_repeat("*", $size);


      $sql = "SELECT link FROM images WHERE
      userid = '$id'
      AND
      profil = '1'";
      if (! $profilPic = $this->connection->query($sql)->fetch(PDO::FETCH_ASSOC))
        $profilPic = "../src/images/default.png";


      $sql = "SELECT link FROM images WHERE
      userid = '$id'
      AND
      profil = '0'";
      if (! $images = $this->connection->query($sql)->fetchAll(PDO::FETCH_ASSOC))
        $images = NULL;


      $sql = "SELECT tag FROM tags WHERE
      userids REGEXP '(,|^)$id(,|$)'";
      $tags_db = $this->connection->query($sql)->fetchAll(PDO::FETCH_ASSOC);
      $j = count($tags_db);
      while ($j-- != 0)
        $tags = !$tags ? $tags_db[$j]['tag'] : $tags . "," . $tags_db[$j]['tag'];
      $tags = explode(',', $tags);


      return [
        'firstname' => $user['firstname'],
        'lastname' => $user['lastname'],
        'email' => $user['email'],
        'birth' => $user['birth'],
        'age' => $user['age'],
        'genre' => $user['gender'],
        'orientation' => $user['orientation'],
        'login' => $user['login'],
        'password' => $crypted,
        'bio' => $user['bio'],
        'city' => $user['city'],
        'dept' => $user['dept'],
        'region' => $user['region'],
        'reg_date' => $user['reg_date'],
        'profilPic' => $profilPic,
        'images' => $images,
        'tags' => $tags,
        'historic today' => $this->getTodayHistorique($id),
        'historic week' => $this->getWeekHistorique($id),
        'liked by' => $this->getLike($id)
      ];
    }

    private function getTodayHistorique($id) {
      $sql = "SELECT * FROM viewers WHERE
      host = '$id'";

      if (! $views = $this->connection->query($sql)->fetchAll(PDO::FETCH_ASSOC))
        return NULL;
      else {
        $viewsCount = count($views) - 1;
        $i = -1;
        $index = 0;
        $curr_stamp = time();

        while ($i++ !=  $viewsCount) {
          $id = $views[$i]['visitor'];

          if (!in_array($id, $checked)) {
            $j = $i - 1;
            $k = 0;

            while ($j++ != $viewsCount) {
              $day = strtotime($views[$j]['visit_date']) + 86400;

              if ($views[$j]['visitor'] == $id && $day > $curr_stamp)
                  $k++;
            }
            $sql = "SELECT firstname, lastname, login, age, city FROM users WHERE
            id = '$id'";
            $ret = $this->connection->query($sql)->fetch(PDO::FETCH_ASSOC);

            $today[$index][id] = $id;
            $today[$index][login] = $ret['login'];
            $today[$index][firstname] = $ret['firstname'];
            $today[$index][lastname] = $ret['lastname'];
            $today[$index][age] = $ret['age'];
            $today[$index][city] = $ret['city'];
            $today[$index][count] = $k;

            $checked[$index] = $id;
            $index++;
          }
        }
        return $today;
      }
    }


    private function getWeekHistorique($id) {
      $sql = "SELECT * FROM viewers WHERE
      host = '$id'";

      if (! $views = $this->connection->query($sql)->fetchAll(PDO::FETCH_ASSOC))
        return NULL;
      else {
        $viewsCount = count($views) - 1;
        $i = -1;
        $index = 0;
        $curr_stamp = time();

        while ($i++ !=  $viewsCount) {
          $id = $views[$i]['visitor'];

          if (!in_array($id, $checked)) {
            $j = $i - 1;
            $k = 0;

            while ($j++ != $viewsCount) {
              $day = strtotime($views[$j]['visit_date']) + 86400;
              $week = strtotime($views[$j]['visit_date']) + 604800;

              if ($views[$j]['visitor'] == $id && $week > $curr_stamp && $day < $curr_stamp)
                  $k++;
            }
            if (!$k)
              continue;
            $sql = "SELECT firstname, lastname, login, age, city FROM users WHERE
            id = '$id'";
            $ret = $this->connection->query($sql)->fetch(PDO::FETCH_ASSOC);

            $thisWeek[$index][id] = $id;
            $thisWeek[$index][login] = $ret['login'];
            $thisWeek[$index][firstname] = $ret['firstname'];
            $thisWeek[$index][lastname] = $ret['lastname'];
            $thisWeek[$index][age] = $ret['age'];
            $thisWeek[$index][city] = $ret['city'];
            $thisWeek[$index][count] = $k;

            $checked[$index] = $id;
            $index++;
          }
        }
        return $thisWeek;
      }
    }


    private function getLike($id) {
      $sql = "SELECT liker FROM likes WHERE
      liked = '$id'";
      $likes = $this->connection->query($sql)->fetchAll(PDO::FETCH_ASSOC);

      $likesCount = count($likes) - 1;
      $i = -1;

      while ($i++ != $likesCount) {
        $id = $likes[$i]['liker'];

        $sql = "SELECT firstname, lastname, login, age, city FROM users WHERE
        id = '$id'";
        $ret = $this->connection->query($sql)->fetch(PDO::FETCH_ASSOC);

        $likedBy[$i][id] = $id;
        $likedBy[$i][login] = $ret['login'];
        $likedBy[$i][firstname] = $ret['firstname'];
        $likedBy[$i][lastname] = $ret['lastname'];
        $likedBy[$i][age] = $ret['age'];
        $likedBy[$i][city] = $ret['city'];
        $likedBy[$i][since] = $ret['like_date'];
      }
      return $likedBy;
    }
}
