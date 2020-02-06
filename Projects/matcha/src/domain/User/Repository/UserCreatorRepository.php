<?php

namespace Src\Domain\User\Repository;

use Src\Domain\User\Data\UserData;
use PDO;

class UserCreatorRepository
{
    private $connection;
    private $token;

    public function __construct(PDO $connection) {
        $this->connection = $connection;
    }

    public function insertUser(UserData $user) {
        $this->token = bin2hex(openssl_random_pseudo_bytes(16, $truc));

        if ($ip = $this->get_user_ip())
          return ['success' => 'ip = ' . $ip];
        else
          return ['error' => 'no ip'];
        $row = [
            'login' => $user->login,
            'password' => $user->password,
            'email' => $user->email,
            'firstname' => $user->firstname,
            'lastname' => $user->lastname,
            'token' => $this->token
          ];

        $sql = "INSERT INTO users SET
                login=:login,
                password=:password,
                firstname=:firstname,
                lastname=:lastname,
                token=:token,
                email=:email;";

        $this->connection->prepare($sql)->execute($row);
        if ($error = $this->sendMail($user))
          return ['error' => $error];
        else
          return ['succes' => 'user created'];

    }


    private function get_user_ip() {
      foreach ( array(
              'HTTP_CLIENT_IP',
              'HTTP_X_FORWARDED_FOR',
              'HTTP_X_FORWARDED',
              'HTTP_X_CLUSTER_CLIENT_IP',
              'HTTP_FORWARDED_FOR',
              'HTTP_FORWARDED',
              'REMOTE_ADDR' ) as $key ) {
                if ( array_key_exists( $key, $_SERVER ) === true ) {
                  foreach ( explode( ',', $_SERVER[ $key ] ) as $ip ) {
                    $ip = trim( $ip );
                    // if ( filter_var( $ip, FILTER_VALIDATE_IP, FILTER_FLAG_NO_PRIV_RANGE | FILTER_FLAG_NO_RES_RANGE ) !== false
                    // && ( ( ip2long( $ip ) & 0xff000000 ) != 0x7f000000 ) )
                      return $ip;
                    }
                  }
        }
    return false;
    }


    private function sendMail($user) {
      $row = [
        'email' => $user->email
      ];

      $sql = "SELECT * FROM users WHERE
      email=:email;";

      $ret = $this->connection->prepare($sql);
      $ret->execute($row);
      $ret = $ret->fetch(PDO::FETCH_ASSOC);

      $to  = $user->email;
      $subject = "Bienvenue sur Matcha";
      $message = '
      <html>
       <head>
       </head>
       <body>
         <h1>Bienvenue ' . $ret['firstname'] . ' !</h1>
         <a href="http://localhost:8080/home?token='. $this->token .'">
         <p>Cliquez ici pour activer votre compte !</p></a>
       </body>
      </html>
      ';
      $headers[] = 'MIME-Version: 1.0';
      $headers[] = 'Content-Type: text/html; charset=utf-8';
      $headers[] = "To: < $to >";
      $headers[] = "From: Matcha <noreply@localhost>";

      if (!mail($to, $subject, $message, implode("\r\n", $headers))) {
        return 'mail not sent';
      }
    }


    public function UserExist(UserData $user) {
      $data['login'] = $user->login;
      $data['email'] = $user->email;

      foreach ($data as $key => $value) {
        $row = [
          $key => $value
        ];

        $sql = "SELECT * FROM users WHERE
        $key=:$key;";

        $ret = $this->connection->prepare($sql);
        $ret->execute($row);
        if ($ret = $ret->fetch(PDO::FETCH_ASSOC))
          return $key;
      }
      return NULL;
    }
}
