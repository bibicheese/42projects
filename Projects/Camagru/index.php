<?php
session_start();
require "php/db.php";

$fake_login = false;
$fake_passwd = false;
$active = true;

if (isset($_GET['token']))
{
  $token = $_GET['token'];
  make_query("UPDATE users SET active=1 WHERE `token` = '$token'");
}

if (isset($_POST['submit']) && $_POST['submit'] == "se connecter")
{
  $login = $_POST['account'];
  $passwd = $_POST['passwd'];
  $ret = make_query("SELECT * FROM users WHERE `login` = '$login'");
  $ret = $ret->fetch(PDO::FETCH_ASSOC);
  if (!$ret)
    $fake_login = true;
  else if ($ret["password"] != $passwd)
    $fake_passwd = true;
  else if ($ret['active'] != 1){
    $active = false;
  }
  if (!$fake_passwd && !$fake_login && $active) {
    $_SESSION['id'] = $ret['id'];
  }
}

?>

<html>
<head>

<title>Photogru</title>
<link rel="stylesheet" href="css/signin.css">
<script type="text/javascript" src="http://code.jquery.com/jquery-latest.min.js"></script>

</head>
<body>

<div id="all2">
  <div id="close2" class="close2">x</div>
  <div id="img_big_container" class="img_big_container">
    <img src="" id="big_img">
  </div>
</div>

<div id="all">
  <div class="login_form">
    <div class="content">
    <div class="header" id="header">
      <div class="title">S'identifier
        <div id="close" class="close">x</div>
      </div>
    </div>
    <form method="post">
    <div class="form">
      <div class="fill">
        <?php
            if ($fake_login)
              echo "<div class=\"error_log\" id=\"error_log\">Le nom de compte est incorrect</div>";
            if ($fake_passwd && !$fake_login)
              echo "<div class=\"error_log\" id=\"error_log\">Le mot de passe est incorrect</div>";
            if (!$active)
              echo "<div class=\"error_log\" id=\"error_log\">Le compte n'est pas activé</div>";
            if ($fake_login || $fake_passwd || !$active) {
              echo "<script>
                document.getElementById('all').style.display = 'block';
                document.getElementById('error_log').style.display = 'block';
                </script>";
            }
           ?>
        <div class="each">
          <label for="account" class="text">Nom de compte</label><br>
          <input type="text" class="champ" placeholder="Nom de compte" name="account" value="<?php if (isset($_POST['account'])) echo $_POST['account']?>" required>
        </div>
        <div class="each">
          <label for="passwd" class="text">Mot de passe</label><br>
          <input type="password" class="champ" placeholder="Mot de passe" name="passwd" required><br><br>
          <a href="php/recover_password.php?page=1" class="forget">Mot de passe oublié ?</a>
        </div>
          <div class="terminate">
            <input class="button" type="submit" name="submit" value="se connecter" required>
          </div>
        </div>
      </div>
    </form>
  </div>
  </div>
</div>

<?php

if (isset($_SESSION['id']) && $_SESSION['id'] != "")
  include ("php/connected_header.php");
else
  include ("php/header.php");

if (isset($_GET['camera']) && $_GET['camera'] == 1)
  include ('php/photo.php');
else
  include ('php/gallery.php');
?>


<script src="js/login.js"></script>

</body>
</html>
