<?php
	session_start();
	include 'includes/conn.php';

	// Check if admin is logged in
	if(!isset($_SESSION['admin']) || trim($_SESSION['admin']) == '') {
		header('Location: ../sign_in');
		exit(); 
	}

	// Get the admin ID from the session
	$userId = $_SESSION['admin'];

	// Use a prepared statement to safely fetch the admin's data
	$conn = $pdo->open();
	$stmt = $conn->prepare("SELECT * FROM admin WHERE id = :id");
	$stmt->execute(['id' => $userId]);
	$user = $stmt->fetch(); // Fetch the data as an associative array

	// Close the PDO connection
	$pdo->close();
?>
