<?php
$dsn = 'mysql:dbname=caltobelli;host=127.0.0.1';
$user = "caltobelli";
$password = "Ronin465$";
try {
	$dbh = new PDO($dsn, $user, $password);
	echo "Success!";
} catch (PDOException $e) {
	echo 'Connection failed: '. $e->getMessage();
}
