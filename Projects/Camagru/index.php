<?php
session_start();
include "db.php";

if (isset($_GET['token']))
{
  $token = $_GET['token'];
  make_query("UPDATE users SET active=1 WHERE `token` = '$token'");
}

?>

<html>
<head>

<title>Photogru.fr</title>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="css/header.css">
<link rel="stylesheet" href="css/signin.css">


</head>
<body>

  <div id="login" class="modal fade" role="dialog">
    <div class="modal-dialog">

      <div class="modal-content">
        <div class="modal-body">
          <button data-dismiss="modal" class="close">&times;</button>
          <h4>S'identifier</h4>
          <form>
            <input type="text" name="username" class="username form-control" placeholder="Username"/>
            <input type="password" name="password" class="password form-control" placeholder="password"/>
            <br>
            <input class="btn login" type="submit" value="s'identifier" />
          </form>
        </div>
      </div>
    </div>
  </div>

<div class="topnav" id="myTopnav">
  <a href="index.php"><img src="ressources/photo.gru.png" class="img"></a>
  <a href="#" class="fa fa-camera-retro"></a>
  <a href="#" class="fa fa-image"></a>
  <a href="php/signup.php" class="burger">S'inscrire</a>
  <a class="burger" onclick="signin()">S'identifier</a>
  <a href="javascript:void(0);" class="icon" onclick="myFunction()">
    <i class="fa fa-bars"></i>
  </a>
</div>

<script src="js/header.js"></script>
</body>
</html>
