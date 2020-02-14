<?php

namespace Src\Domain\User\Repository;

use PDO;
use Src\Domain\User\Repository\SortListRepository;

class EveryoneGetterRepository
{
    private $connection;
    private $sortList;

    public function __construct(PDO $connection, SortListRepository $sortList) {
        $this->connection = $connection;
        $this->sortList = $sortList;
    }

    public function get($id, $instruc) {
      $sql = "SELECT latitude, longitude FROM users WHERE
      id = '$id'";
      $ret = $this->connection->query($sql)->fetch(PDO::FETCH_ASSOC);
      $latFrom = $ret['latitude'];
      $lonFrom = $ret['longitude'];

      $select = "firstname,
                age,
                gender,
                city,
                id,
                login,
                score,
                latitude,
                longitude,
                token_log";
      $sql = "SELECT $select FROM users
      WHERE
      id != '$id'";
      $ret = $this->connection->query($sql)->fetchAll(PDO::FETCH_ASSOC);

      $sql = "SELECT tag FROM tags WHERE
      userids REGEXP '(,|^)$id(,|$)'";
      $userTags = $this->connection->query($sql)->fetchAll(PDO::FETCH_ASSOC);
      $j = count($userTags);
      while ($j-- != 0) {
          $tags = !$tags ? $userTags[$j]['tag'] : $tags . "," . $userTags[$j]['tag'];
      }
      $myTags = explode(',', $tags);
      
      $i = 0; 
      foreach ($ret as $key => $value) {
        $id = $ret[$i]['id'];
        $gender = $ret[$i]['gender'];
        $latTo = $ret[$i]['latitude'];
        $lonTo = $ret[$i]['longitude'];

        $sql = "SELECT tag FROM tags WHERE
        userids REGEXP '(,|^)$id(,|$)'";
        $userTags = $this->connection->query($sql)->fetchAll(PDO::FETCH_ASSOC);
        $j = count($userTags);
        $sameTag = 0;
        while ($j-- != 0) {
            if (in_array($userTags[$j]['tag'], $myTags))
              $sameTag++;
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

        // $tags = explode(',', $tags);
        // $ret[$i][tags] = $tags;
        unset($ret[$i]['latitude']);
        unset($ret[$i]['longitude']);
        $ret[$i][log] = $ret[$i]['token_log'] ? 1 : 0;
        unset($ret[$i]['token_log']);
        $ret[$i][dst] = $this->getDistance($latFrom, $lonFrom, $latTo, $lonTo);
        $ret[$i][profilePic] = $profilPic['link'];
        $ret[$i][sameTag] = $sameTag;
        $i++;
        // $tags = NULL;
      }
      
      $sorted = $this->sortList->sort($ret, $instruc);
      
      return $sorted;
    }
    
    
    private function getDistance($latFrom, $lonFrom, $latTo, $lonTo) {
        $degrees = rad2deg(acos((sin(deg2rad($latFrom))*sin(deg2rad($latTo))) + (cos(deg2rad($latFrom))*cos(deg2rad($latTo))*cos(deg2rad($lonFrom-$lonTo)))));
        $distance = $degrees * 111.13384;

        return round($distance, $decimals);    
    }
}