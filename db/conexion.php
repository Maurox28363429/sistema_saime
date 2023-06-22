<?php
	$host = "localhost"; // your host name
	$username = "mau"; // your MySQL username
	$password = "mau"; // your MySQL password
	$dbname = "miguel_saime"; // your MySQL database name

	// create a new mysqli connection
	$mysqli = mysqli_connect($host, $username, $password, $dbname);
	// check the connection
	if (!$mysqli) {
		die("Connection failed: " . mysqli_connect_error());
	}
	$conn = mysqli_connect($host, $username, $password, $dbname);
?>