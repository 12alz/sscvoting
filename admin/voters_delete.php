<?php
	include 'includes/session.php';

	if(isset($_POST['delete'])){
		$id = $_POST['id'];
		$sql = "UPDATE voters SET recstat = 1 WHERE id = '$id'";
		if($conn->query($sql)){
			echo "
			Swal.fire({
				icon: 'success',
				title: 'Success!',
				text: '".$_SESSION['success']."',
				onClose: () => {
					window.location.href = 'voters.php';
				}
			});
		";
		
			// $_SESSION['success'] = 'The records was successfully archived';
		}
		else{
			$_SESSION['error'] = $conn->error;
		}
	}
	else{
		$_SESSION['error'] = 'An error occured during the archiving process.';
	}

	header('location: voters.php');

	

?>