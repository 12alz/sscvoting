<?php
					// host 		// username		// password 	// database;
	$conn = new mysqli('mccsscvoting.com', 'u510162695_votesystem', '1Votesystem', 'u510162695_votesystem');

	if ($conn->connect_error) {
	    die("Connection failed: " . $conn->connect_error);
	}
	
?>