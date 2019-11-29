<?php
session_start();
require "db.php";
$login = $_SESSION['login'];

$old_passwd = true;
$confirm = true;

$ret = make_query("SELECT * FROM users WHERE `login` = '$login'");
$ret = $ret->fetch(PDO::FETCH_ASSOC);

if (isset($_POST['submit']) && $_POST['submit'] == "valider")
{
  if ($_POST['old_passwd'] != $ret['password']) {
    $old_passwd = false;
  }
  else if ($_POST['new_passwd'] != $_POST['confirm'])
    $confirm = false;
  else {
    $new_passwd = $_POST['new_passwd'];
    make_query("UPDATE users SET `password` = '$new_passwd' WHERE `login` = '$login'");
  }
}
if (isset($_POST['submit_delete']) && $_POST['submit_delete'] == "supprimer son compte")
{
  make_query("DELETE FROM users WHERE `login` = '$login'");
  $_SESSION['login'] = "";
  header("location: ../index.php");
}
?>

<html>

<head>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="../css/personal_account.css">

</head>
<body>

<div class="topnav">
    <div class="logo">
        <a href="../index.php"><img src="../ressources/photo.gru.png" class="img"></a>
    </div>
</div>

<div class="info">INFORMATIONS</div>
<hr class="top_one">

<div class="first">
  <strong class="text">Nom du compte :</strong>
  <?php echo "<span class=\"show\">".$_SESSION['login']."</span>";?>
</div>

<hr class="other_one">

<div class="each">
  <strong class="text">Identité :</strong>
  <?php echo "<span class=\"show\">".$ret['lastname']."  ".$ret['firstname']."</span>";?>
</div>

<hr class="other_one">

<div class="each">
  <strong class="text">Date de naissance :</strong>
  <?php echo "<span class=\"show\">".$ret['birth']."</span>";?>
</div>

<hr class="other_one">

<div class="each">
  <strong class="text">Mot de passe :</strong>
  <?php echo "<span class=\"show\">**********</span>";?>
  <i class="fa fa-edit" onclick="show_passwd_modify()"></i>
</div>

  <div class="passwd_modify" id="passwd_modify">
    <form method="post">
      <label for="old_passwd" class="text_modify">Votre mot de passe actuel*</label><br>
      <input type="password" id="old_passwd" class="champ" placeholder="Votre mot de passe actuel" name="old_passwd" required><br>
      <?php
      if (!$old_passwd) {
        echo "<p class=\"error_msg\">Le mot de passe est incorrect</p>";
        echo "<script>
            document.getElementById('passwd_modify').style.display = 'block';
            </script>";
          }
      ?><br>
      <label for="new_passwd" class="text_modify">Nouveau mot de passe*</label><br>
      <input type="password" id="password" class="champ" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}"placeholder="Nouveau mot de passe" name="new_passwd" required><br>
      <div id="message">
        <h3>Le mot de passe doit au moins contenir :</h3>
        <p id="letter" class="invalid">Une <b>miniscule</b></p>
        <p id="capital" class="invalid">Une <b>majuscule</b></p>
        <p id="number" class="invalid">Un <b>nombre</b></p>
        <p id="length" class="invalid">Un minimum de <b>8 caracteres</b></p>
      </div>
      <label for="confirm" class="text_modify">Confirmer le nouveau mot de passe*</label><br>
      <input type="password" id="confirm_password" class="champ" placeholder="Confirmer le nouveau mot de passe" name="confirm" required>
      <div class="terminate">
          <input class="button" type="submit" name="submit" value="valider" required>
      </div>
    </div>

        <hr class="other_one">
      <div class="each">
        <strong class="text">E-mail :</strong>
        <?php echo "<span class=\"show\">".$ret['email']."</span>";?>
      </div>

      <hr class="other_one">

      </form>
      <form method="post">
      <input type="submit" class="delete" name="submit_delete" value="supprimer son compte">
      </form>

<script src="../js/confirm_passwd.js"></script>
<script src="../js/strength_passwd.js"></script>
<script src="../js/modify_passwd.js"></script>
</body>
</html>
