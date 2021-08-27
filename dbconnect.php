<?php
	$host = 'localhost';
	$username = 'root';
	$password = '';
	$dbname = 'phpdemo';
	$json = array();
	$conn = mysqli_connect($host, $username, $password, $dbname);
	mysqli_set_charset($conn, 'utf8');
	// Check connection
	if ($conn->connect_error) {
	    die("Connection failed: " . $conn->connect_error);
	}
?>