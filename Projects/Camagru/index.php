<?php
$dbname = "camagru";$servername = "127.0.0.1:8080";
$username = "camagru_admin";
$password = "123456";

try {
	$conn = new PDO("mysql:host=$servername;dbname=mydb", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = "CREATE DATABASE mydb";
	$conn->exec($sql);
	echo "db created successfully<br>";
}
catch(PDOException $e) {
    echo $sql."<br>".$e->getMessage();
}
$conn = null;
	
)
?>


<html>
<head>

<title>Photogru.fr</title>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="css/header.css">

</head>
<body>

<div class="topnav" id="myTopnav">
  <a href="index.html"><img src="ressources/photo.gru.png" class="img"></a>
  <a href="#" class="fa fa-camera-retro"></a>
  <a href="#" class="fa fa-image"></a>
  <a href="#" class="burger">S'inscrire</a>
  <a href="#" class="burger">S'identifier</a>
  <a href="javascript:void(0);" class="icon" onclick="myFunction()">
    <i class="fa fa-bars"></i>
  </a>
</div>

<script src="js/header.js"></script>
</body>
</html>