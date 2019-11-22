<?php

function create_table($conn) {
	$user_table = "users";
	try {
		$conn->query("CREATE TABLE IF NOT EXISTS $user_table (
                      id INT UNIQUE AUTO_INCREMENT PRIMARY KEY,
                      firstname VARCHAR(30) NOT NULL,
                      lastname VARCHAR(30) NOT NULL,
                      email VARCHAR(50) UNIQUE NOT NULL,
                      birth VARCHAR(30) NOT NULL,
                      age INT NOT NULL,
                      login VARCHAR(30) NOT NULL UNIQUE,
                      password VARCHAR(30) NOT NULL,
                      active INT NOT NULL DEFAULT 0,
                      reg_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP)");
	}
	catch(PDOException $e) {
		echo "table failed:".$e->getMessage();
	}
}

function make_query($query) {
	global $conn;
	$conn->query($query);
}

$host = "localhost";
$port = "3306";
$dbname = "mydb";
$user = "camagru";
$paswd = "123456";
try {
	$conn = new PDO("mysql:host=$host", $user, $paswd);
	$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$conn->query("CREATE DATABASE IF NOT EXISTS $dbname");
	$conn->query("use $dbname");
	create_table($conn);
}
catch(Exception $e) {
	echo "Error : ".$e->getMessage();
}
?>
