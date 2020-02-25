<?php
function check_id($id)
{
    if (file_exists("private/new_product") && file_exists("private/product")) 
    {
        $newproduct = file_get_contents("private/new_product");
		$product = file_get_contents("private/product");
		if ($newproduct != "")
        {
            $newproduct = unserialize($newproduct);
            foreach ($newproduct as $key => $value)
            {
				if ($value['id'] == $id)
					return false;
            }
        }
		if ($product != "")
        {
            $product = unserialize($product);
            foreach ($product as $key => $value)
            {
				if ($value['id'] == $id)
					return false;
            }
		}
    }
    return true;
}

if ($_POST['submit'] == "Ajouter")
{
	if (!check_id($_POST['id']))
		echo"id deja pris\n";
	else if (!is_numeric($_POST['prix']) || $_POST['prix'] < 0)
	  echo"Prix non valide\n";
	else
	{
		$dir = "private";
		$file = $dir."new_product";
		if (!file_exists($dir))
			mkdir($dir);
		if (!file_exists($file))
			file_put_contents($file, null);
		$account = unserialize(file_get_contents('private/new_product'));
		$tmp['id'] = $_POST['id'];
		$tmp['prix'] = $_POST['prix'];
		$tmp['url'] = $_POST['url'];
		$tmp['categorie'] = "nouveaute";
		$account[] = $tmp;
		file_put_contents('private/new_product', serialize($account));
		header('location: header2.php');
	}
}
?>

<html>
<body>

    <form method="POST" action="">
	Id: <br/><input type="text" name="id" required><br/><br/>
	Prix: <br/><input type="text" name="prix" required><br/><br/>
	url:<br/><input type="text" name="url" required><br/><br/>
	<input class="submitbutton" type="submit" name="submit" value="Ajouter">
    </form>

</body>
</html>