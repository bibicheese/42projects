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
