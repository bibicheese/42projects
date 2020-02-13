<?php

namespace Src\Domain\User\Repository;

use PDO;

class checkUserLoggedRepository
{
    private $connection;

    public function __construct(PDO $connection) {
        $this->connection = $connection;
    }
  
    public function check($UserLog) {
      $id = $UserLog->id;
      $token = $UserLog->token;
      
      $sql = "SELECT * FROM users WHERE
      id = '$id'";
      if (! $ret = $this->connection->query($sql)->fetch(PDO::FETCH_ASSOC))
        return "user no exist";
      
      return $ret['token_Log'];
      // if (! $ret['token_log'])
        
        
      if ($token != $ret['token'])
        return "token not good";
    }
}