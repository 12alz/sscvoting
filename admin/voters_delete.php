<?php
	include 'includes/session.php';

	if(isset($_POST['delete'])){
		$id = $_POST['id'];
		
		// Update the recstat to 1 (archived) and reset the is_registered to 0 (not registered)
		$sql = "UPDATE voters SET recstat = 1, is_registered = 0 WHERE id = '$id'";

		if($conn->query($sql)){
			$_SESSION['success'] = 'The record was successfully archived and user registration reset.';
		}
		else{
			$_SESSION['error'] = $conn->error;
		}
	}
	else{
		$_SESSION['error'] = 'An error occurred during the archiving process.';
	}

	header('location: voters');
?>
