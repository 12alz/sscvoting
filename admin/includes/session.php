<?php
	session_start();
	include 'includes/conn.php';

	if(!isset($_SESSION['admin']) || trim($_SESSION['admin']) == ''){
		header('location: ../sign_in');
		exit();
	}

	$stmt = $conn->prepare("SELECT * FROM admin WHERE id = ?");
	$stmt->bind_param('s', $_SESSION['admin']);
	$stmt->execute();
	$result = $stmt->get_result();

	if($result->num_rows=0){
		header('location: ../sign_in');
		exit();
	}



	$sql = "SELECT * FROM admin WHERE id = '".$_SESSION['admin']."'";
	$query = $conn->query($sql);
	$user = $query->fetch_assoc();
	
?>