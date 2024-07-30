<?php
// database credential
$host = "127.0.0.1:3306";
$dbname = "u510162695_votesystem";
$username = "u510162695_votesystem";
$password = "1Votesystem";

//create connection
	$conn = new mysqli($host, $username, $password, $dbname);

	if ($conn->connect_error) {
	    die("Connection failed: " . $conn->connect_error);
		//echo "Connection Failed";
	}
	//echo "Connection Success"; 
?>