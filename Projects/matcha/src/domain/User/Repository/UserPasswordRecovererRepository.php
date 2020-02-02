<?php

namespace Src\Domain\User\Repository;

use PDO;

class UserPasswordRecovererRepository
{
    private $connection;


    public function __construct(PDO $connection) {
        $this->connection = $connection;
    }


    public function sendMail($email) {
      $token = bin2hex(openssl_random_pseudo_bytes(4, $truc));

      $row = [
        'email' => $email
      ];

      $sql = "SELECT * FROM users WHERE
      email=:email;";

      $ret = $this->connection->prepare($sql);
      $ret->execute($row);
      if (!$ret = $ret->fetch(PDO::FETCH_ASSOC))
        return ['error' => 'mail is not registered'];

      $to  = $email;
      $subject = "Récupération du mot de passe";
      $message = '
        <html>
         <head>
         </head>
         <body>
           <p>Bonjour ' . $ret['firstname'] . ',</p><br>
           <p>Vous avez demandé à recevoir un nouveau mot de passe pour votre compte
           <b>' . $ret['login'] . '</b>.</p>
           <p>Il vous suffit de <b>copier le code ci-dessous
           puis de le renseigner sur la page de récupération correspondante.</b></p><br><br>
           <center><b style="font-size: 26px;">' . $token . '</b></center>
         </body>
        </html>
        ';
        $headers[] = 'MIME-Version: 1.0';
        $headers[] = 'Content-Type: text/html; charset=utf-8';
        $headers[] = "To: < $email >";
        $headers[] = "From: Matcha <noreply@localhost>";

        if (mail($to, $subject, $message, implode("\r\n", $headers))) {
          $row = [
            'token' => $token,
            'email' => $email
          ];

          $sql = "UPDATE users SET
          token=:token
          WHERE
          email=:email;";

          $this->connection->prepare($sql)->execute($row);

          $file = '../src/tmp/recovery.txt';
          file_put_contents($file, $email);
          return ['success' => 'mail has been sent'];
        }

        else
          return ['error' => 'mail has not been sent'];
    }


    public function confirmToken($token) {
      $file = '../src/tmp/recovery.txt';
      $email = file_get_contents($file);

      $row = [
        'token' => $token,
        'email' => $email
      ];

      $sql = "SELECT * FROM users WHERE
      token=:token
      AND
      email=:email;";

      $ret = $this->connection->prepare($sql);
      $ret->execute($row);
      if (!$ret = $ret->fetch(PDO::FETCH_ASSOC))
        return ['error' => 'token not correct'];
      else {
          file_put_contents($file, ';' . $token, FILE_APPEND);
          return ['success' => 'token is correct'];
      }
    }


    public function insertPassword($password) {
      $file = '../src/tmp/recovery.txt';
      $check = explode(';', file_get_contents($file));

      $row = [
        'email' => $check[0],
        'token' => $check[1],
        'password' => $password
      ];

      $sql = "UPDATE users SET
      password=:password
      WHERE
      email=:email
      AND
      token=:token;";

      $this->connection->prepare($sql)->execute($row);
      unlink($file);
      return ['succes' => 'password has been changed'];
    }

    public function verifyPassword($password) {
      $file = '../src/tmp/recovery.txt';
      $check = explode(';', file_get_contents($file));

      $row = [
        'email' => $check[0],
        'token' => $check[1],
      ];

      $sql = "SELECT * FROM users WHERE
      email=:email
      AND
      token=:token;";

      $ret = $this->connection->prepare($sql);
      $ret->execute($row);
      $ret = $ret->fetch(PDO::FETCH_ASSOC);
      if ($ret['password'] == $password)
        return ['error' => 'password same'];

    }
}
