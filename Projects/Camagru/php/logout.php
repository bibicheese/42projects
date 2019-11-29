<?php
if (isset($_POST['logout'])) {
  if ($_SESSION['login'] && $_SESSION['login'] != "")
  {
    $_SESSION['login'] = "";
    header("location: index.php");
  }
}

?>
