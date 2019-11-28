<?php
require "db.php";
session_start();
$i = 8;
$login = $_SESSION['login'];

if (strlen($login) > $i) {
  $login[++$i] = ".";
  $login[++$i] = ".";
  while (++$i < strlen($login))
    $login[$i] = "\0";
}
?>

<html>
<head>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="../css/header.css">
<link rel="stylesheet" href="../css/menu.css"

</head>
<body>

<div class="topnav" id="myTopnav">
  <a href="connected.php"><img src="../ressources/photo.gru.png" class="img"></a>
  <a href="#" class="fa fa-camera-retro"></a>
  <a href="#" class="fa fa-image"></a>
  <a href="javascript:void(0);" class="burger" id="login" onclick="open_menu()"><?php echo $login; ?></a>
  <div class="menu">
    <div class="logout">Se deconnecter</div>
    <div class="my_account">Mon compte</div>
  </div>
  </a>
</div>

<script src="../js/menu_connected.js"></script>
</body>
</html>
