<?php
	include 'includes/session.php';

	if(isset($_POST['edit'])){
		$id = $_POST['id'];
		$sql = "DELETE FROM voters WHERE id = '$id'";
		if($conn->query($sql)){
			$_SESSION['success'] = ' The records was successfully delete';
		}
		else{
			$_SESSION['error'] = $conn->error;
		}
	}
	else{
		$_SESSION['error'] = 'An error occured during the delete process.';
	}

	header('location: trash.php');
	
?>