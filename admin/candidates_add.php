<?php
	include 'includes/session.php';

	if(isset($_POST['add'])){
		$firstname = htmlspecialchars($_POST['firstname']);
		$lastname = htmlspecialchars($_POST['lastname']);
		$position = htmlspecialchars($_POST['position']);
		$course = $_POST['course'];
		$platform = $_POST['platform'];
		$filename = $_FILES['photo']['name'];
		$validImageExtension = ['jpg', 'jpeg', 'png'];
    $imageExtension = explode('.', $filename);
    $imageExtension = strtolower(end($imageExtension));
    if ( !in_array($imageExtension, $validImageExtension) ){
    
    $_SESSION['error'] =  'Invalid Image Extension';
    }
    	else{
		if(!empty($filename)){
			move_uploaded_file($_FILES['photo']['tmp_name'], '../images/'.$filename);	
		}

		$sql = "INSERT INTO candidates (position_id, firstname, lastname, course, photo, platform) VALUES ('$position', '$firstname', '$lastname', '$course', '$filename', '$platform')";
		if($conn->query($sql)){
			$_SESSION['success'] = 'Candidate added successfully';
		}
		else{
			$_SESSION['error'] = $conn->error;
		}
	}
	}
	else{
		$_SESSION['error'] = 'Fill up add form first';
	}

	header('location: candidates');
?>