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

    public function get($mainId, $instruc) {
      $sql = "SELECT latitude, longitude FROM users WHERE
      id = '$mainId'";
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
      id != '$mainId'";
      $ret = $this->connection->query($sql)->fetchAll(PDO::FETCH_ASSOC);

      $sql = "SELECT tag FROM tags WHERE
      userids REGEXP '(,|^)$mainId(,|$)'";
      $userTags = $this->connection->query($sql)->fetchAll(PDO::FETCH_ASSOC);
      $j = count($userTags);
      while ($j-- != 0) {
          $tags = !$tags ? $userTags[$j]['tag'] : $tags . "," . $userTags[$j]['tag'];
      }
      $myTags = explode(',', $tags);
      
      $i = 0; 
      foreach ($ret as $key => $value) {
        $userid = $ret[$i]['id'];
        $gender = $ret[$i]['gender'];
        $latTo = $ret[$i]['latitude'];
        $lonTo = $ret[$i]['longitude'];

        $sql = "SELECT tag FROM tags WHERE
        userids REGEXP '(,|^)$userid(,|$)'";
        $userTags = $this->connection->query($sql)->fetchAll(PDO::FETCH_ASSOC);
        $j = count($userTags);
        $sameTag = 0;
        $tags = NULL;
        while ($j-- != 0) {
            if (in_array($userTags[$j]['tag'], $myTags))
              $sameTag++;
            $tags = !$tags ? $userTags[$j]['tag'] : $tags . "," . $userTags[$j]['tag'];
        }
        $tags = explode(',', $tags);
        $sql = "SELECT link FROM images WHERE
        userid = '$userid'
        AND
        profil = '1'";
        if (! $profilPic = $this->connection->query($sql)->fetch(PDO::FETCH_ASSOC)) {
            if ($gender == 'Male')
              $profilPic = "/img/male.jpg";
            elseif ($gender == 'Female')
              $profilPic = "/img/female.jpg";
        }
        else
          $profilPic = $profilPic['link'];
        $sql = "SELECT * FROM likes WHERE
        liker = '$mainId'
        AND
        liked = '$userid'";
        $myLikeTo = $this->connection->query($sql)->fetch(PDO::FETCH_ASSOC);
        
        $sql = "SELECT * FROM likes WHERE
        liker = '$userid'
        AND
        liked = '$mainId'";
        $likedBy = $this->connection->query($sql)->fetch(PDO::FETCH_ASSOC);
        
        if ($likedBy && $myLikeTo) {
          $match = 1;
        }
          

        $ret[$i]['age'] = (int)$ret[$i]['age'];
        $ret[$i]['score'] = (int)$ret[$i]['score'];
        $ret[$i][likedBy] = $likedBy ? 1 : 0;
        $ret[$i][myLikeTo] = $myLikeTo ? 1 : 0;
        $ret[$i][match] = $match ? 1 : 0;
        $ret[$i][log] = $ret[$i]['token_log'] ? 1 : 0;
        $ret[$i][dst] = $this->getDistance($latFrom, $lonFrom, $latTo, $lonTo);
        $ret[$i][sameTag] = $sameTag;
        $ret[$i][profilePic] = $profilPic;
        $ret[$i][tags] = $tags;
        unset($ret[$i]['latitude']);
        unset($ret[$i]['longitude']);
        unset($ret[$i]['token_log']);
        $match = 0;
        $i++;
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