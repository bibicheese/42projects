<?php
require_once("database.php");

try {
  $db = new db();
  $db->create();
  $db = NULL;
}
catch (PDOException $e) {
  echo "Error : " . $e->getMessage();
}

?>
