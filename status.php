<?php
	$conn = new mysqli('localhost', 'root', '', 'votesystem');

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