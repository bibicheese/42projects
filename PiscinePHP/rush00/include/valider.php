<?php
session_start();
function vider_panier()
{
    $vide = false;
    unset($_SESSION['panier']);
    if(!isset($_SESSION['panier']))
    {
        $vide = true;
    }
    return $vide;
}
if ($_POST["valider"] === "VALIDER LA COMMANDE")
{
	if ($_SESSION['login'] && $_SESSION['login'] != "")
	{
		if (isset($_SESSION['panier']) && count($_SESSION['panier']['id']) != 0)
		{
			vider_panier();
			$_SESSION['panier'] = null;
			echo " Nous avons la joie immense de vous confirmer votre commande";
		}
		else
			echo " Ooops, votre panier est vide :'(";
	}
	else
		echo " Veuillez vous connecter pour valider votre commande";
}
?>