<?php
	include 'includes/session.php';
	$sql = "UPDATE votes SET stat = 0";
	if($conn->query($sql)){
		$_SESSION['success'] = "The records was successfully restored";
	}
	else{
		$_SESSION['error'] = "An error occured during the restored process.";
	}

	header('location: archive');

?>