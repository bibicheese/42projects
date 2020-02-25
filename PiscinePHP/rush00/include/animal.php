<?php
include"logout_delete.php";
?>


<html>
	<head>
		<link href="../style/bootstrap2.css" type ="text/css" rel="stylesheet"/>
	</head>

	</br><a href="/index.php"><h1 class="titre">Peluches Lovers'</h1></br>
</a></br>

<body>


<?php

if ($_SESSION['login'] && $_SESSION['login'] != "")
{
    echo"<p class='utilisateur'>";
    echo"Bienvenue ".$_SESSION['login'];
    echo"<form action='' method='post'>";
    echo"<input class='visu' type='submit' name='deco' value='Se Deconnecter'>";
    echo"<input class='visu' type='submit' name='suppr' value='Supprimer son compte'>";
    echo"<a class='visu' href='/include/panier.php'>Pannier</a></p><form></p>";
    if ($_SESSION['login'] == "root")
    {
        echo"<p class='utilisateur'>";
        echo"<a class='visu' href='/include/create_data_base.php'>Ajouter un produit</a></p>";
    }
}
else
{
    echo"<p class='utilisateur'>";
    echo"<a class='visu' href='/include/login.php'>S'identifier</a>";
    echo"<a class='visu' href='/include/create_account.php'>Pas encore client ?</a>";
    echo"<a class='visu' href='/include/panier.php'>Pannier</a></p></p>";
}
?>
	<nav>
		<ul>
			<li><a href="/index.php">Acceuil</a></li>
			<li><a href="/include/nouveautes.php">Nouveautes</a></li>
			<li class="deroulant"><a href="#">Categories &ensp;</a>
				<ul class="sous">
						<li><a href="/include/animal.php">Peluches animales</a></li>
						<li><a href="/include/musical.php">Peluches Musicales et lumineuses</a></li>
						<li><a href="/include/geante.php">Peluches geantes</a></li>
						<li><a href="/include/naissance.php">Cadeau special naissance</a></li>
						<li><a href="/include/promo.php">Promos</a></li>
				</ul>
			</li>
			<li><a href="/include/cadeau.php">Idees cadeaux</a></li>
			<li><a href="/include/baisse.php">Prix en baisse</a></li>
		</ul>
	</nav>
	</br></br></br>
	<center>
	<div>
		<img class="photo" SRC="/ressources/lumineuse1.jpg"></img>
		<img class="photo" SRC="/ressources/lumineuse2.jpeg"></img>
		<img class="photo" SRC="/ressources/promo1.jpeg"></img>
	</div>
	<p class="styleprix"><em>2€</em><em class="tentative">2€</em><em>2€</em></p>

	<div class="acheter">
    <form  class="go" method="POST" action="panier.php">
                <input class="acheter" type="submit" name="lumineuse1" value="Ajouter au Panier"/>
                <input class="acheter" type="submit" name="lumineuse2" value="Ajouter au Panier"/>
                <input class="acheter" type="submit" name="promo1" value="Ajouter au Panier"/>
        </form>
    
    </div>
	</br></br></br>
	<div>
		<img class="photo" SRC="/ressources/promo2.jpeg"></img>
		<img class="photo" SRC="/ressources/promo3.jpeg"></img>
		<img class="photo" SRC="/ressources/promo4.jpeg"></img>
	</div>
	<p class="styleprix"><em>2€</em><em class="tentative">2€</em><em>2€</em></p>

 <div class="acheter">
    <form  class="go" method="POST" action="panier.php">
                <input class="acheter" type="submit" name="promo2" value="Ajouter au Panier"/>
                <input class="acheter" type="submit" name="promo3" value="Ajouter au Panier"/>
                <input class="acheter" type="submit" name="promo4" value="Ajouter au Panier"/>
        </form>

    </div>
	</br></br></br>
	<div>
		<img class="photo" SRC="/ressources/animal1.jpeg"></img>
		<img class="photo" SRC="/ressources/animal2.jpeg"></img>
		<img class="photo" SRC="/ressources/animal3.jpeg"></img>
	</div>
	<p class="styleprix"><em>2€</em><em class="tentative">2€</em><em>2€</em></p>

 <div class="acheter">
    <form  class="go" method="POST" action="panier.php">
                <input class="acheter" type="submit" name="animal1" value="Ajouter au Panier"/>
                <input class="acheter" type="submit" name="animal2" value="Ajouter au Panier"/>
                <input class="acheter" type="submit" name="animal3" value="Ajouter au Panier"/>
        </form>

    </div>

	</br></br></br>
	<div>
		<img class="photo" SRC="/ressources/animal4.jpeg"></img>
		<img class="photo" SRC="/ressources/geante1.jpeg"></img>
		<img class="photo" SRC="/ressources/geante2.jpg"></img>
	</div>
	<p class="styleprix"><em>2€</em><em class="tentative">2€</em><em>2€</em></p>

	 <div class="acheter">
    <form  class="go" method="POST" action="panier.php">
                <input class="acheter" type="submit" name="animal4" value="Ajouter au Panier"/>
                <input class="acheter" type="submit" name="geante1" value="Ajouter au Panier"/>
                <input class="acheter" type="submit" name="geante2" value="Ajouter au Panier"/>
        </form>

    </div>

	</br></br></br>
	<div>
		<img class="photo" SRC="/ressources/geante3.jpg"></img>

	</div>
	<p class="styleprix"><em class="tentative">2€</em></p>

 <div class="acheter">
    <form  class="go" method="POST" action="panier.php">
                <input class="acheter" type="submit" name="geante3" value="Ajouter au Panier"/>
        </form>

    </div>

	</center>


</html>



