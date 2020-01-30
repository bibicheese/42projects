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
      $sql = "SELECT * FROM users WHERE `email` = '$email'";
      if (!$ret = $this->connection->query($sql)->fetch(PDO::FETCH_ASSOC))
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
          $sql = "UPDATE users SET `token` = '$token' WHERE `email` = '$email'";
          $this->connection->query($sql);
          file_put_contents("../../../tmp/recovery.txt", $email);
          return ['success' => 'mail has been sent'];
        }
        else
          return ['error' => 'mail has not been sent'];
    }
    public function confirmToken($token) {
      $sql = "SELECT * FROM users WHERE `token` = '$token'";
      if (!$ret = $this->connection->query($sql)->fetch(PDO::FETCH_ASSOC))
        return ['error' => 'token not correct'];
      else
        return ['success' => 'token correct'];
    }
    public function insertPassword($password) {

    }
}
