
<html>
<head>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="css/header.css">

</head>
<body>
<div class="topnav" id="myTopnav">
  <img src="ressources/photo.gru.png" class="img">

  <?php
  if (isset($_GET['camera']) && $_GET['camera'] == 1)
    echo "<a href=\"index.php\" class=\"fa fa-image\"></a>";
  else {
    echo "<a href=\"index.php?camera=1\" class=\"fa fa-camera-retro\"></a>";
  }
  ?>

  <a href="php/signup.php" class="burger">S'inscrire</a>
  <a class="burger" id="login">S'identifier</a>
  <a href="javascript:void(0);" class="icon" onclick="myFunction()">
    <i class="fa fa-bars"></i>
  </a>
</div>

<script src="js/header.js"></script>
</body>
</html>
