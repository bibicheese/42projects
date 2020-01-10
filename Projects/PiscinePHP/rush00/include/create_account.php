<?php 
session_start();
function check_login($login)
{
    if (file_exists("private/accounts"))
	{
		$datas = file_get_contents("private/accounts");
		if ($datas != "")
		{
			$datas = unserialize($datas);
			foreach ($datas as $key => $value)
			{
				if ($value['login'] == $login)
					return false;
			}
		}
	}
    return true;
}

if ($_POST['submit'] == "Creer son compte")
{
	if (!$_POST['login'] || !$_POST['passwd'] || !$_POST['lastname'] || !$_POST['firstname'] || !$_POST['mail'])
	{
		echo"Un champ est manquant\n";
	}
	else if (!check_login($_POST['login']))
	{
		echo"Nom de compte deja pris\n";
	}
	else
	{
		$salt = file_get_contents("private/salt");
		$data = array();
		$data['login'] = $_POST['login'];
		$login = $_POST['passwd'];
		$data['passwd'] = hash("whirlpool", "$salt.$login");
		$data['mail'] = $_POST['mail'];
		$data['lastname'] = $_POST['lastname'];
		$data['firstname'] = $_POST['firstname'];
		if (!file_exists("private/accounts"))
		{
			$account = array($data);
			$ser = serialize($account);
			file_put_contents("private/accounts", $ser);
			$_SESSION['login'] = $_POST['login'];
			header('location: header2.php');
		}
		else
		{
			$file = file_get_contents("private/accounts");
			$accounts = unserialize($file);
			$i = 0;
			while ($accounts[$i])
				$i++;
			$accounts[$i] = $data;
			$ser = serialize($accounts);
			file_put_contents("private/accounts", $ser);
			$_SESSION['login'] = $_POST['login'];
			header('Location: header2.php');
		}
	}
}
?>

<html>
<body>
  <form action="" method="post">
    Nom <br /><input type="text" name="lastname" value="" required>
    <br />
    <br />
    Pr&eacutenom <br /><input type="text" name="firstname" value="" required>
    <br />
    <br />
    Adresse Mail <br /><input type="email" name="mail" value="" required>
    <br />
    <br />
    Nom du compte <br /><input type="text" name="login" value="" required>
    <br />
    <br />
    Mot de passe <br /><input type="password" name="passwd" value="" required>
    <br />
    <br />
    <input type="submit" name="submit" value="Creer son compte" required>
	</form>
	</body>
	</html>
	
