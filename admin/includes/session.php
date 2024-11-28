<?php
	session_start();
	include 'includes/conn.php';

	// Check if the user is logged in
	if (!isset($_SESSION['admin']) || trim($_SESSION['admin']) == '') {
		header('Location: ../sign_in');
		exit(); 
	}

	$user_id = $_SESSION['admin'];

	// Prepare the query to avoid SQL injection
	$sql = "SELECT * FROM admin WHERE id = ?";
	$stmt = $conn->prepare($sql);
	$stmt->bind_param("i", $user_id); // "i" means the parameter is an integer
	$stmt->execute();
	$result = $stmt->get_result();

	// Fetch user data if available
	$user = $result->fetch_assoc();

	// Close the statement and connection
	$stmt->close();
	$conn->close();
?>
