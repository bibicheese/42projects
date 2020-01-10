<?php
session_start();
if ($_SESSION['login'] && $_SESSION['login'] != "")
{
    if ($_POST['deco'] == "Se Deconnecter")
    {
        $_SESSION['login'] = "";
        header('location: header2.php');
    }
    if ($_POST['suppr'] == "Supprimer son compte")
    {
        $file = file_get_contents("private/accounts");
        $accounts = unserialize($file);
        foreach ($accounts as $key => $value)
        {
            if ($value['login'] == $_SESSION['login'])
                unset($accounts[$key]);
        }
        $ser = serialize($accounts);
        file_put_contents("private/accounts", $ser);
        $_SESSION['login'] = "";
        header('location: header2.php');
    }
}
?>