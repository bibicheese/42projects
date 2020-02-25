<?php
session_start();
function auth($login, $passwd)
{
	if (file_exists("private/accounts"))
	{
		$file = file_get_contents("private/accounts");
		if ($file != "")
		{
			$accounts = unserialize($file);
			$salt = file_get_contents("private/salt");
			$hashed = hash("whirlpool", "$salt.$passwd");
			foreach ($accounts as $key => $value)
			{
				if ($login == $value["login"] && $hashed == $value["passwd"])
					return true;
			}
		}
	}
	return false;
}
if ($_POST['submit'] == "se connecter")
{
	if (auth($_POST['login'], $_POST['passwd']))
	{
		$_SESSION['login'] = $_POST['login'];
		header('location: header2.php');
	}
	else
	{
		$_SESSION['login'] = "";
		echo"Erreur dans le nom de compte ou le mot de passe\n\n";
	}
}
?>

<html>
<body>
  <form action="" method="post">
    Nom de compte <br /><input type="text" name="login" value="" required><br /><br />
    Mot de passe <br /><input type="password" name="passwd" value="" required><br /><br />
     <input type="submit" name="submit" value="se connecter">
  </form>
</body>
</html>


