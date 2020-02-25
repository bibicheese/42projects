<?php
session_start(); 
?>
<head>
<link href="../style/bootstrap2.css" type ="text/css" rel="stylesheet"/>
	</head>

	</br><em class="achats"><a href="http://localhost:8080/rush00/include/header2.php"><h1 class="titre">Votre Panier</h1></br>
</a></em></br>

<body>

<header class="banner">
</header>

	</br></br></br>

<?php
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
function verif_panier($select) 
{ 
    $i = 0;
    $count = count($_SESSION['panier']['id']);
	while ($i < $count + 1)
    {
        if ($_SESSION['panier']['id'][$i] === $select['id'])
        {
            $_SESSION['panier']['quantite'][$i] = $_SESSION['panier']['quantite'][$i] + 1;
            return (1);
        }
        $i++;
    }
  
	return (0);
}  
if(!isset($_SESSION['panier'])) 
{ 
    $_SESSION['panier'] = array();     
    $_SESSION['panier']['id'] = array(); 
    $_SESSION['panier']['prix'] = array(); 
    $_SESSION['panier']['quantite'] = array();
} 
if ($_POST["lamentin"] === "Ajouter au Panier")
{
    $select = array();
    $select['id'] = 'lamentin';
    $select['prix'] = '2';
    $select['quantite'] = '1';
}
if ($_POST["pingouin"] === "Ajouter au Panier")
{
    $select = array();
    $select['id'] = 'pingouin';
    $select['prix'] = '2';
    $select['quantite'] = '1';
}
if ($_POST["agneau"] === "Ajouter au Panier")
{
    $select = array();
    $select['id'] = 'agneau';
    $select['prix'] = '2';
    $select['quantite'] = '1';
}
if ($_POST["ours"] === "Ajouter au Panier")
{
    $select = array();
    $select['id'] = 'ours';
    $select['prix'] = '2';
    $select['quantite'] = '1';
}
if ($_POST["girafe"] === "Ajouter au Panier")
{
    $select = array();
    $select['id'] = 'girafe';
    $select['prix'] = '2';
    $select['quantite'] = '1';
}
if ($_POST["cheval"] === "Ajouter au Panier")
{
    $select = array();
    $select['id'] = 'cheval';
    $select['prix'] = '2';
    $select['quantite'] = '1';
}
if ($_POST["animal4"] === "Ajouter au Panier")
{
    $select = array();
    $select['id'] = 'animal4';
    $select['prix'] = '2';
    $select['quantite'] = '1';
}
if ($_POST["lumineuse1"] === "Ajouter au Panier")
{
    $select = array();
    $select['id'] = 'lumineuse1';
    $select['prix'] = '2';
    $select['quantite'] = '1';
}
if ($_POST["lumineuse2"] === "Ajouter au Panier")
{
    $select = array();
    $select['id'] = 'lumineuse2';
    $select['prix'] = '2';
    $select['quantite'] = '1';
}
if ($_POST["naissance1"] === "Ajouter au Panier")
{
    $select = array();
    $select['id'] = 'naissance1';
    $select['prix'] = '2';
    $select['quantite'] = '1';
}
if ($_POST["naissance2"] === "Ajouter au Panier")
{
    $select = array();
    $select['id'] = 'naissance2';
    $select['prix'] = '2';
    $select['quantite'] = '1';
}
if ($_POST["naissance3"] === "Ajouter au Panier")
{
    $select = array();
    $select['id'] = 'naissance3';
    $select['prix'] = '2';
    $select['quantite'] = '1';
}
if ($_POST["promo1"] === "Ajouter au Panier")
{
    $select = array();
    $select['id'] = 'promo1';
    $select['prix'] = '2';
    $select['quantite'] = '1';
}
if ($_POST["promo2"] === "Ajouter au Panier")
{
    $select = array();
    $select['id'] = 'promo2';
    $select['prix'] = '2';
    $select['quantite'] = '1';
}
if ($_POST["promo3"] === "Ajouter au Panier")
{
    $select = array();
    $select['id'] = 'promo3';
    $select['prix'] = '2';
    $select['quantite'] = '1';
}
if ($_POST["promo4"] === "Ajouter au Panier")
{
    $select = array();
    $select['id'] = 'promo4';
    $select['prix'] = '2';
    $select['quantite'] = '1';
}
if ($select != null)
{
    if (verif_panier($select) == 1)
    {
     
    }
    else{
        
        array_push($_SESSION['panier']['id'],$select['id']); 
        array_push($_SESSION['panier']['quantite'],$select['quantite']); 
        array_push($_SESSION['panier']['prix'],$select['prix']); 
    }
}
$prix = 0;
foreach($_SESSION['panier']['prix'] as $elem)
{
    $prix = $prix + $elem;
}
$count = count($_SESSION['panier']['id']);
$i = 0;
$final = 0;
while ($_SESSION['panier']['id'][$i])
{
    echo "Article : ";
    echo $_SESSION['panier']['id'][$i];
    ?></br><?php
    echo " Quantite : ";
    echo $_SESSION['panier']['quantite'][$i];
    ?></br><?php
    echo " Prix / Article : ";
    echo $_SESSION['panier']['prix'][$i];
    echo " Euros ";
    ?></br><?php
    echo " Prix total pour cet article : ";
    $res = $_SESSION['panier']['prix'][$i] * $_SESSION['panier']['quantite'][$i];
    echo $res;
    echo " Euros ";
    $final = $final + $res;
    ?></br></br><?php
    
    $i++;
}
echo " Prix total pour votre commande : ";
echo $final;
echo " Euros ";
    ?> 
    <form  method="POST" action="valider.php">
    <input  class="go" type="submit" name="valider" value="VALIDER LA COMMANDE"/>
   
</form>
<?php
?> 