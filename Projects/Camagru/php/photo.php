<?php

global $dossier;
global $fichier;
$id = $_SESSION['id'];
$dossier = "ressources/tmp/";
$name = "img_tmp".$id.".png";
$fichier = basename($name);

$webcam_data = $_POST['webcam_data'];
if ($webcam_data != "")
{
  list($type, $webam_data) = explode(';', $webcam_data);
  list(, $webcam_data)     = explode(',', $webcam_data);
  $webcam_data = base64_decode($webcam_data);
  if (file_exists($dossier . $fichier))
    unlink($dossier . $fichier);
  file_put_contents($dossier . $fichier, $webcam_data);
  echo "wsh le sang";
}
else {
  echo "fdp";
}


if (isset($_POST['submit_photo']) && $_POST['submit_photo'] == "Envoyer")
{
  if (file_exists($dossier.$fichier))
    unlink($dossier.$fichier);
  if (move_uploaded_file($_FILES['import_img']['tmp_name'], $dossier . $fichier))
    echo "";
}

if (isset($_POST['shoot']) && $_POST['shoot'] == "Enregistrer")
{
  $filtre = $_POST['filtre'];
  if (!file_exists($dossier . $fichier))
    echo "";
  else if (isset($_SESSION['id']) && $_SESSION['id'] != "")
  {
    if ($filtre == "aucun")
    {
      $name = openssl_random_pseudo_bytes(20, $truc);
      $name = bin2hex($name);
      $gallery = "ressources/gallery/";
      $link = $gallery . $name . ".png";
      if (rename($dossier . $fichier, $link))
      {
        if (file_exists($dossier.$fichier))
          unlink($dossier.$fichier);
        make_query("INSERT INTO pictures (link, userid) VALUES (\"$link\", \"$id\")");
        echo "enregistrer avec succès";
      }
    }
    else {
      $source = imagecreatefrompng($dossier . $fichier);
      $filtre = imagecreatefrompng("ressources/filtres/" . $filtre . ".png");
      $height_source = imagesx($source);
      $width_source = imagesy($source);
      imagecopymerge($source, $filtre, 0, 0, 0, 0, $width_source, $height_source, 100);
      imagejpeg($source);
      echo "on est là";
    }
  }
  else
    echo "Vous devez être connecté";
}

?>

<html>
<head>

<link rel="stylesheet" href="css/photo.css">

</head>
<body onresize="set_width()">

<div class="all_page">
  <div id="filtres">
    <form method="post" enctype="multipart/form-data">
      <p>
        <input type="radio" name="filtre" value="noel" onclick="send_data('noel')">
        <label for="noel">Noël</label>
      </p>
      <p>
        <input type="radio" name="filtre" value="halloween" onclick="send_data('halloween')">
        <label for="halloween">Halloween</label>
      </p>
      <p>
        <input type="radio" name="filtre" value="ocean" onclick="send_data('ocean')">
        <label for="ocean">Océan</label>
      </p>
      <p>
        <input type="radio" name="filtre" value="fumée" onclick="send_data('fumée')">
        <label for="fumée">Fumée</label>
      </p>
      <p>
        <input type="radio" name="filtre" value="plage" onclick="send_data('plage')">
        <label for="plage">Plage</label>
      </p>
      <p>
        <input type="radio" name="filtre" value="trou_noir" onclick="send_data('trou_noir')">
        <label for="trou_noir">Trou noir</label>
      </p>
      <p>
        <input type="radio" name="filtre" value="foret" onclick="send_data('foret')">
        <label for="foret">Forêt</label>
      </p>
      <p>
        <input type="radio" name="filtre" value="feu" onclick="send_data('feu')">
        <label for="feu">Feu</label>
      </p>
      <p>
        <input type="radio" name="filtre" value="aucun" onclick="send_data('aucun')" checked>
        <label for="aucun">Aucun</label>
      </p>
  </div>

    <div class="img_place_photo">
      <img id="img_photo" class="img_photo"
      src="
      <?php
      if(file_exists($dossier.$fichier))
        echo $dossier.$fichier;
      ?>
      ">
      <img id="filtre_photo" class="filtre_photo" src="">
    </div>
    <div class="pick">
        <input type="file" accept="image/*" id="import_img" name="import_img" onchange="loadFile(event)">
        <label class="label_import" for="import_img">Choisir un fichier</label>
        <input type="submit" name="submit_photo" class="submit_photo" value="Envoyer">
      </div>
      <input type="submit" name="shoot" class="shoot" value="Enregistrer">
      </form>
  <br>
  <br>
  <br>
  <br>
  <div id="webcam">
    <div class="video_section">
      <video id="video"></video>
      <button id="startbutton">Prendre une photo</button>
    </div>
    <canvas id="canvas" style="display: none;"></canvas>
  </div>
</div>

<script src="js/photo.js"></script>
</body>
</html>
