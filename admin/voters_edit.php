<?php
	include 'includes/session.php';

	if(isset($_POST['edit'])){
		$id = $_POST['id'];
		$firstname = $_POST['firstname'];
		$lastname = $_POST['lastname'];
		$password = password_hash($_POST['password'], PASSWORD_DEFAULT);
		$course = $_POST['course'];

		$sql = "UPDATE voters SET firstname = '$firstname', lastname = '$lastname', password = '$password' , course = '$course' ,  WHERE id = '$id'";
		if($conn->query($sql)){
			$_SESSION['success'] = 'Voter updated successfully';
		}
		else{
			$_SESSION['error'] = $conn->error;
		}
		}
	else{
		$_SESSION['error'] = 'Voter Updated Error';
	}

	header('location: voters.php');

?>