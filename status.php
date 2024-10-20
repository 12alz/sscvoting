<?php
	$conn = new mysqli('127.0.0.1:3306', 'u510162695_votesystem', '1Votesystem', 'u510162695_votesystem');

	if ($conn->connect_error) {
	    die("Connection failed: " . $conn->connect_error);
	}


    $sql = "SELECT switch FROM admin";
    $query = $conn->query($sql);
    $row = $query->fetch_assoc();
    $status = $row['switch'];

    echo json_encode(['switch' => $status]);
    $conn->close();
?>