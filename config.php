<?php

// Database connection
if (session_status() == PHP_SESSION_NONE) {
	session_start();
}

function get_connection() {
	static $connection;

	if(!isset($connection)) {
		$connection = mysqli_connect('localhost','gititfresh','hserftitig3420','gititfresh')
			or die(mysqli_connect_error());
	}
	if($connection === false) {
		echo "Unable to connect to database<br/>";
		echo mysqli_connect_error();
	}

	return $connection;
}

header('Content-type: application/json');

?>
