<?php

namespace Src\Domain\User\Repository;

use Src\Domain\User\Data\UserData;
use PDO;

class UserLoggerRepository
{
    private $connection;

    public function __construct(PDO $connection) {
        $this->connection = $connection;
    }

    public function indentifyUser(UserData $user) {
      $email = $user->email;
      $password = $user->password;

      $row = [
        'email' => $email
      ];

      $sql = "SELECT * FROM users WHERE
      email=:email;";

      $ret = $this->connection->prepare($sql);
      $ret->execute($row);
      if (!$ret = $ret->fetch(PDO::FETCH_ASSOC))
        return "email";

      else if ($ret['password'] != $password)
        return "password";

      else if ($ret['active'] == 0)
        return "active";

      else
        return $ret['id'];
    }

    public function locate(UserData $user) {
      $email = $user->email;

      $access_token = 'd068dfed09a69b';
      $client = new IPinfo($access_token);
      $ip = $this->get_user_ip();
      $details = $client->getDetails($ip);

      $row = [
        'enail' => $email,
        'city' => $details->city,
        'dept' => substr($details->postal, 0, 2),
        'region' => $details->region
      ];

      $sql = "UPDATE users SET
      city=:city,
      dept=:dept,
      region=:regiona
      WHERE
      email=:email;";

      $this->connection->prepare($sql)->execute($row);
    }

    private function get_user_ip() {
      $server = array(
              'HTTP_CLIENT_IP',
              'HTTP_X_FORWARDED_FOR',
              'HTTP_X_FORWARDED',
              'HTTP_X_CLUSTER_CLIENT_IP',
              'HTTP_FORWARDED_FOR',
              'HTTP_FORWARDED',
              'REMOTE_ADDR' );
      foreach ( $server as $key ) {
        if ( array_key_exists( $key, $_SERVER ) === true ) {
          foreach ( explode( ',', $_SERVER[ $key ] ) as $ip ) {
              $ip = trim( $ip );
              if ( filter_var( $ip, FILTER_VALIDATE_IP, FILTER_FLAG_NO_PRIV_RANGE | FILTER_FLAG_NO_RES_RANGE ) !== false
              && ( ( ip2long( $ip ) & 0xff000000 ) != 0x7f000000 ) )
              return $ip;
          }
        }
      }
    return "163.172.250.12";
    }
}
