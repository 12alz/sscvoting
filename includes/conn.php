<?php
	$conn = new mysqli('u510162695_', 'u510162695_', '1Votesystem', 'u510162695_');

	if ($conn->connect_error) {
	    die("Connection failed: " . $conn->connect_error);
	}
	
?>