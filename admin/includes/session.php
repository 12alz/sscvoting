<?php
	session_start();
	include 'includes/conn.php';

	if(!isset($_SESSION['admin']) || trim($_SESSION['admin']) == ''){
		header('Location: ../sign_in');
		exit(); 
	}

	$user = $_SESSION['admin'];

	$sql = "SELECT * FROM admin WHERE id = $user";
	$query = $conn->query($sql);
	$user = $query->fetch_assoc();
?>