<?php
	$user = 'root';
	$password = '';
	$dbname = 'cms';
	$server = 'localhost';
	
	
	$conn = new mysqli($server, $user,$password, $dbname) or die(mysql_error()); // Connect to database server(localhost) with username and password.
	
	if ($conn->connect_error) {
    	die("Connection failed: " . $conn->connect_error);
	} 
?>
