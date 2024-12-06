<?php
// database credential
$host = "127.0.0.1:3306";
$dbname = "u510162695_votesystem";
$username = "u510162695_votesystem";
$password = "1Votesystem";

$host = "127.0.0.1";
$dbname = "u953213971_foxrock_db";
$username = "foxrock";
$password = "u953213971_foxrock_db";



//create connections
	$conn = new mysqli($host, $username, $password, $dbname);

	if ($conn->connect_error) {
	    die("Connection failed: " . $conn->connect_error);
		//echo "Connection Faileds";
	}
	//echo "Connection Successs"s;

	
?>