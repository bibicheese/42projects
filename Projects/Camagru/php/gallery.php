<html>
<head>

<link rel="stylesheet" href="css/gallery.css">
</head>
<body>

<form id="form_search" method="post">
  <div class="search_bar">
    <input class="bar" name="search" type="text" placeholder="Rechercher.." required>
    <input class="loupe" type="image" src="ressources/loupe.png">
  </div>
</form>

<div id="must_connected_like" class="must_connected">
  <p class="error_msg">Vous devez être connecté pour pouvoir aimer.</p>
</div>
<div id="must_connected_comment"class="must_connected">
  <p class="error_msg">Vous devez être connecté pour pouvoir commenter.</p>
</div>

<?php

if (isset($_POST['search']))
{
  echo "ça marche pas encore <br><br>";
}
else {
  $ret = make_query("SELECT COUNT(*) FROM pictures");
  $ret = $ret->fetch(PDO::FETCH_ASSOC);
  $nb_pic = $ret['COUNT(*)'];
  $i = $nb_pic;
}

if ($nb_pic > 0)
{
  while ($i > 0)
  {
    if (isset($_POST["comment$i"]))
    {
      if (isset($_SESSION['id']) && $_SESSION['id'] != "")
      {
        $com = $_POST["comment$i"];
        $id = $_SESSION['id'];
        make_query("INSERT INTO comments (comm, userid, imgid) VALUES (\"$com\", \"$id\", \"$i\")");
        $picture_db = make_query("SELECT * FROM pictures WHERE `id` = '$i'");
        $picture_db = $picture_db->fetch(PDO::FETCH_ASSOC);
        $userid = $picture_db['userid'];
        $user_db_pic = make_query("SELECT * FROM users WHERE `id` = '$userid'");
        $user_db_pic = $user_db_pic->fetch(PDO::FETCH_ASSOC);
        $user_db_curr = make_query("SELECT * FROM users WHERE `id` = '$id'");
        $user_db_curr = $user_db_curr->fetch(PDO::FETCH_ASSOC);
        if ($picture_db['userid'] != $id && $user_db_pic['notif'] == 1)
          {
            $login_curr = $user_db_curr['firstname'] . " " . $user_db_curr['lastname'];
            $publication = $picture_db['link'];
            $img_data = file_get_contents($publication);
            $img_data = base64_encode($img_data);
            $to = $user_db_pic['email'];
            $subject = "Photogru: Notification !";
            $img = "data:image/png;base64," . $img_data;
            $addr = $_SERVER['REMOTE_ADDR'];
            $message = "
            <html>
             <head>
             </head>
             <body>
               <h1>$login_curr a commenté votre publication !</h1>
               <p>$com</p>
             </body>
            </html>
            ";
            $headers[] = 'MIME-Version: 1.0';
            $headers[] = 'Content-Type: text/html; charset=utf-8';
            $headers[] = "To: < $to >";
            $headers[] = "From: Camagru <noreply@localhost>";
            mail($to, $subject, $message, implode("\r\n", $headers));
          }
      }
      else {
        echo "
        <script>
        document.getElementById(\"must_connected_comment\").style.display = \"flex\";
        $(\"#must_connected_comment\").fadeOut(5000);
        </script>";
      }
    }
    $pic = make_query("SELECT * FROM pictures WHERE `id` = '$i'");
    $pic = $pic->fetch(PDO::FETCH_ASSOC);
    $userid = $pic['userid'];
    $user = make_query("SELECT * FROM users WHERE `id` = '$userid'");
    $user = $user->fetch(PDO::FETCH_ASSOC);
    $name = $user['firstname'] . " " . $user['lastname'];
    $description = $pic['description'];
    $link = $pic['link'];
    echo "<div class=\"gallery_content\">
            <div class=\"header_content\">
              <p class=\"user\">$name</p>
              <p class=\"description\">$description</p>
            </div>
            <div class=\"gallery_img_place\">
              <img src=\"$link\" class=\"gallery_img\" onclick=\"display_big('$link')\">
            </div>";
            $ret = make_query("SELECT COUNT(*) FROM comments WHERE `imgid` = '$i'");
            $ret = $ret->fetch(PDO::FETCH_ASSOC);
            $nb_com = $ret['COUNT(*)'];
            $ret = make_query("SELECT COUNT(*) FROM likes WHERE `pictureid` = '$i'");
            $ret = $ret->fetch(PDO::FETCH_ASSOC);
            $nb_likes = $ret['COUNT(*)'];
            echo "
            <div class=\"count_likes_com\">
              <div class=\"count_likes\">
                <p id=\"nb_like$i\">$nb_likes j'aime</p>
              </div>
              <div class=\"count_coms\">";
              if ($nb_com < 2)
                echo "<p onclick=\"
                if (document.getElementById('comment_place$i').style.display == 'block')
                  document.getElementById('comment_place$i').style.display = 'none';
                else {
                  document.getElementById('comment_place$i').style.display = 'block'
                }
                  \">$nb_com commentaire</p>";
              else
                echo "<p onclick=\"
                if (document.getElementById('comment_place$i').style.display == 'block')
                  document.getElementById('comment_place$i').style.display = 'none';
                else {
                  document.getElementById('comment_place$i').style.display = 'block'
                }
                  \">$nb_com commentaires</p>";
              echo "
              </div>
            </div>
            <div class=\"likes_coms\">
              <div class=\"like_place\">
                <form method=\"post\">
                  <div class=\"tamere\">";
                  if (isset($_SESSION['id']))
                  {
                    $id = $_SESSION['id'];
                    $ret = make_query("SELECT * FROM likes WHERE `userid` = '$id' AND `pictureid` = '$i'");
                    $ret = $ret->fetch(PDO::FETCH_ASSOC);
                    if ($ret)
                    {
                      echo "<i id=\"thumb$i\" class=\"fa fa-thumbs-up blue\"><input id=\"like$i\" name=\"like$i\" type=\"button\" value=\"J'aime\" class=\"like blue\"";
                      if (isset($_SESSION['id']) && $_SESSION['id'] != "")
                       echo "onclick=\"add_like('$i')\"";
                      echo "></i>";
                     }
                    else
                    {
                      echo "<i id=\"thumb$i\" class=\"fa fa-thumbs-up\"><input id=\"like$i\" name=\"like$i\" type=\"button\" value=\"J'aime\" class=\"like\"";
                      if (isset($_SESSION['id']) && $_SESSION['id'] != "")
                       echo "onclick=\"add_like('$i')\"";
                      echo "></i>";
                    }
                  }
                  else {
                    echo "<i id=\"thumb$i\" class=\"fa fa-thumbs-up\"><input id=\"like$i\" name=\"like$i\" type=\"button\" value=\"J'aime\" class=\"like\"";
                    if (isset($_SESSION['id']) && $_SESSION['id'] != "")
                     echo "onclick=\"add_like('$i')\"";
                    echo "></i>";
                  }
                  echo "
                  </div>
                </form>
              </div>
              <div class=\"coms\">
                <i class=\"fa fa-comment\" onclick=\"
                if (document.getElementById('comment_place$i').style.display == 'block')
                  document.getElementById('comment_place$i').style.display = 'none';
                else {
                  document.getElementById('comment_place$i').style.display = 'block'
                }
                  \"> Commenter</i>
              </div>
            </div>
            <div id=\"comment_place$i\" class=\"comment_place\">
              <form method=\"post\">
                <input name=\"comment$i\" type=\"text\" class=\"comment_post\" placeholder=\"Votre commentaire..\">
              </form>";
              $ret = make_query("SELECT COUNT(*) FROM comments");
              $ret = $ret->fetch(PDO::FETCH_ASSOC);
              $nb_com = $ret['COUNT(*)'];
              $j = 0;
              while ($j <= $nb_com)
              {
                $coms = make_query("SELECT * FROM comments WHERE `imgid` = '$i' AND `id` = '$j'");
                $coms = $coms->fetch(PDO::FETCH_ASSOC);
                $userid = $coms['userid'];
                $user = make_query("SELECT * FROM users WHERE `id` = '$userid'");
                $user = $user->fetch(PDO::FETCH_ASSOC);
                $login = $user['firstname'] . " " . $user['lastname'];
                $comment = $coms['comm'];
                if ($comment)
                  echo "
                  <div class=\"Comment_container\">
                    <div class=\"comment\">
                      <span class=\"comment_login\">$login </span><span class=\"comment_text\"> $comment</span>
                    </div>
                  </div>
                  ";
                $j++;
              }
              echo "
            </div>
          </div>";
          $i--;
    }
}
else {
  echo "
  <div class=\"all\">
    <p class=\"nothing\">Rien à afficher</p>
  </div>";
}

?>

<script src="js/gallery.js"></script>
</body>
</html>
