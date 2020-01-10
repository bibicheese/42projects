<?php
// session_start();

if (isset($_POST['like']))
  echo "yessss";
else {
  echo "noooo";
}
// {
//   $i = $_POST['like'];
//   if (isset($_SESSION['id']) && $_SESSION['id'] != "")
//   {
//     $id = $_SESSION['id'];
//     $ret = make_query("SELECT * FROM likes WHERE `userid` = '$id' AND `pictureid` = '$i'");
//     $ret = $ret->fetch(PDO::FETCH_ASSOC);
//     if ($ret)
//       make_query("DELETE FROM likes WHERE `userid` = '$id' AND `pictureid` = '$i'");
//     else
//     {
//       make_query("INSERT INTO likes (userid, pictureid) VALUES (\"$id\", \"$i\")");
//       $picture_db = make_query("SELECT * FROM pictures WHERE `id` = '$i'");
//       $picture_db = $picture_db->fetch(PDO::FETCH_ASSOC);
//       $userid = $picture_db['userid'];
//       $user_db_pic = make_query("SELECT * FROM users WHERE `id` = '$userid'");
//       $user_db_pic = $user_db_pic->fetch(PDO::FETCH_ASSOC);
//       $user_db_curr = make_query("SELECT * FROM users WHERE `id` = '$id'");
//       $user_db_curr = $user_db_curr->fetch(PDO::FETCH_ASSOC);
//       if ($picture_db['userid'] != $id && $user_db_pic['notif'] == 1)
//         {
//           $login_curr = $user_db_curr['firstname'] . " " . $user_db_curr['lastname'];
//           $publication = $picture_db['link'];
//           $to = $user_db_pic['email'];
//           $subject = "Photogru: Notification !";
//           $message = "
//           <html>
//            <head>
//            </head>
//            <body>
//              <h1>$login_curr a aimé votre publication !</h1>
//              <img href=\"http://localhost:8080/camagru/$publication\">
//            </body>
//           </html>
//           ";
//           $headers[] = 'MIME-Version: 1.0';
//           $headers[] = 'Content-Type: text/html; charset=utf-8';
//           $headers[] = "To: < $to >";
//           $headers[] = "From: Camagru <noreply@localhost>";
//           mail($to, $subject, $message, implode("\r\n", $headers));
//         }
//     }
//   }
//   else {
//     echo "
//     <script>
//     document.getElementById(\"must_connected_like\").style.display = \"flex\";
//     $(\"#must_connected_like\").fadeOut(5000);
//     </script>";
//   }
// }

?>
