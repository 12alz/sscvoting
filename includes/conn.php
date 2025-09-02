<?php
// database credential
$host = "localhost";
$dbname = "voting";
$username = "root";
$password = "";

//create connections
	$conn = new mysqli($host, $username, $password, $dbname);

	if ($conn->connect_error) {
	    die("Connection failed: " . $conn->connect_error);
		//echo "Connection Faileds";
	}
	//echo "Connection Successs"s;

	
?>
