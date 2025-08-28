<?php
// database credential
$host = "127.0.0.1:3306";
$dbname = "u602214709_event";
$username = "u602214709_event1";
$password = "Event$@13";

//create connections
	$conn = new mysqli($host, $username, $password, $dbname);

	if ($conn->connect_error) {
	    die("Connection failed: " . $conn->connect_error);
		//echo "Connection Faileds";
	}
	//echo "Connection Successs"s;

	
?>
