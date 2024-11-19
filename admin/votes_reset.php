<?php
	include 'includes/session.php';
	$sql = "UPDATE votes SET stat = 1";
	if($conn->query($sql)){
		$_SESSION['success'] = "The records was successfully archived";
	}
	else{
		$_SESSION['error'] = "An error occured during the archiving process.";
	}

	header('location: votes');

?>