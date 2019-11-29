<?php
include "logout.php";
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
<link rel="stylesheet" href="css/connected_header.css">

</head>
<body>

<div class="topnav" id="myTopnav">
  <a href="index.php"><img src="ressources/photo.gru.png" class="img"></a>
  <a href="#" class="fa fa-camera-retro"></a>
  <a href="#" class="fa fa-image"></a>
  <div class="burger" onclick="open_menu()">
    <i class="fa fa-user"></i>
    <a href="javascript:void(0);" class="account"><?php echo $login; ?></a>
    </a>
</div>
</div>

<div class="menu">
  <form method="post">
    <button type="submit" class="log" name="logout">Se deconnecter</button>
  </form>
  <a href="php/personal_account.php" class="account"><div class="log">Mon compte</div></a>
</div>

<script src="js/connected.js"></script>
</body>
</html>
