<?php
	session_start();
	include 'includes/conn.php';

	
	if (!isset($_SESSION['admin']) || trim($_SESSION['admin']) == '') {
		header('Location: ../sign_in');
		exit(); 
	}

	$user_id = $_SESSION['admin'];

	$sql = "SELECT * FROM admin WHERE id = ?";
	$stmt = $conn->prepare($sql);
	$stmt->bind_param("i", $user_id); /
	$stmt->execute();
	$result = $stmt->get_result();

	// Fetch user data if available
	$user = $result->fetch_assoc();

	// Close the statement and connection
	$stmt->close();
	$conn->close();
?>
