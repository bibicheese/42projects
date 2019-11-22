<?php
require "../db.php";
session_start();

if (isset($_POST['submit']) && $_POST['submit'] == "Terminer l'inscription")
{
	$birthDate = $_POST['birth_day']."/".$_POST['birth_month']."/".$_POST['birth_year'];
	$birthDate = explode("/", $birthDate);
	$age = (date("md", date("U", mktime(0, 0, 0, $birthDate[0], $birthDate[1], $birthDate[2]))) > date("md") ? ((date("Y") - $birthDate[2]) - 1) : (date("Y") - $birthDate[2]));

	if ($_POST['birth_day'] < 10 || $_POST['birth_month'] < 10)
	{
		$day = "0".$_POST['birth_day'];
		$month = "0".$_POST['birth_month'];
	}
	//$birthDate = $day."/".$month."/".$_POST['birth_year'];
	//$mail = $_POST['mail'];
	$login = $_POST['login'];
	//$passwd = $_POST['passwd'];
	//$firstname = $_POST['firstname'];
	//$lastname = $_POST['lastname'];
	make_query("SELECT login FROM users WHERE login = $login");
	//make_query("INSERT INTO users (firstname, lastname, email, password, login, birth, age) VALUES (\"$firstname\", \"$lastname\", \"$mail\", \"$passwd\", \"$login\", \"$birthDate\", \"$age\")");
	//header("location: ../index.php");
}

?>

<html>
<head>
	<title>S'inscrire</title>
	<link rel="stylesheet" href="../css/singup.css">
</head>
<body>

<div class="topnav">
    <div class="logo">
        <a href="../index.php"><img src="../ressources/photo.gru.png" class="img"></a>
    </div>
</div>

<img src="../ressources/signup.jpg" class="img2">

<div class="form-sub">
    <div class="content-sub">
        <div class="header">
        <div class="title">Créez votre compte</div>
        </div>
        <div class="row">
            <div class="elements">
                <form action="" method="post">
                        <label for="login" class="text">Nom de compte*</label>
                        <input type="text" id="login" class="champ" placeholder="Nom de compte" name="login" required>
												<p class="error_login">Nom de compte non disponible</p>
			<!--							<div class="each">
                        <label for="passwd" class="text">Mot de passe*</label>
                        <input type="password" id="password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" class="champ" placeholder="Mot de passe" name="passwd" required>
											</div>
                    <div id="message">
                        <h3>Le mot de passe doit au moins contenir:</h3>
                        <p id="letter" class="invalid">Une <b>miniscule</b></p>
                        <p id="capital" class="invalid">Une <b>majuscule</b></p>
                        <p id="number" class="invalid">Un <b>nombre</b></p>
                        <p id="length" class="invalid">Un minimum de <b>8 caracteres</b></p>
                    </div>
                    <div class="each">
                        <label for="confirm" class="text">Confirmation du mot de passe*</label>
                        <input type="password" id="confirm_password" class="champ" placeholder="Confirmation du mot de passe" name="confirm" required>
                    </div>
                    <div class="each">
                        <label for="mail" class="text">E-mail*</label>
                        <input type="email" id="mail" class="champ" placeholder="E-mail" name="mail" required>
                    </div>
                    <div class="each">
                        <label for="firstname" class="text">Prénom*</label>
                        <input type="text" class="champ" placeholder="Prénom" name="firstname" required>
                    </div>
                    <div class="each">
                        <label for="lastname" class="text">Nom*</label><br>
                        <input type="text" class="champ" placeholder="Nom" name="lastname" required>
                    </div>
                    <div class="each">
                        <p class="text">Date de naissance*</p>
                        <div class="day">
                            <select class="select" name="birth_day" required>
                                <option value="">Jour</option>
                            <?php
                               for($i = 1; $i <= 31; ++$i)
                               {
                                   echo "<option value=\"$i\">";
                                   if($i < 10)
                                      echo "0";
                                   echo "$i";
                                   echo "</option>";
                               }
                            ?>
 							</select>
                            <select class="select" name="birth_month" required>
                                <option value="">Mois</option>
                                <option value="1">Janvier</option>
                                <option value="2">Février</option>
                                <option value="3">Mars</option>
                                <option value="4">Avril</option>
                                <option value="5">Mai</option>
                                <option value="6">Juin</option>
                                <option value="7">Juillet</option>
                                <option value="8">Août</option>
                                <option value="9">Septembre</option>
                                <option value="10">Octobre</option>
                                <option value="11">Novembre</option>
                                <option value="12">Décembre</option>
                            </select>
                            <select class="select" name="birth_year" required>
                                <option value="">Année</option>
								<?php
                                    for($i = 2019; $i >= 1900; $i--)
                                    {
                                        echo "<option value=\"$i\">";
                                        echo "$i";
                                        echo "</option>";
                                    }
                                ?>
                            </select>
                        </div>
                    </div> -->
                    <div class="terminate">
                        <input class="button" type="submit" name="submit" value="Terminer l'inscription" required>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script src="../js/confirm_passwd.js"></script>
<script src="../js/strength_passwd.js"></script>

</body>
</html>
