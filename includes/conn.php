<?php
echo "hello world";
// database credential
$host = "localhost";
$dbname = "u510162695_votesystem";
$username = "u510162695_votesystem";
$password = "1Votesystem";

//create connection
	$conn = new mysqli($host, $username, $password, $dbname);

	if ($conn->connect_error) {
	    die("Connection failed: " . $conn->connect_error);
	}
	
?>