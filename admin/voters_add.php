<?php
	include 'includes/session.php';

	if(isset($_POST['add'])){
		$firstname = $_POST['firstname'];
		$lastname = $_POST['lastname'];
		$password = password_hash($_POST['password'], PASSWORD_DEFAULT);
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
		
		$course = $_POST['course'];
		$voters_id = $_POST['voters_id'];
		$checkUser = "SELECT * FROM voters WHERE voters_id ='$voters_id'";
		$result = mysqli_query($conn , $checkUser);
		$count = mysqli_num_rows($result);
		if($count>0){
				$_SESSION['error'] = 'Voter added error';
			}
		else{
			$sql = "INSERT INTO voters (voters_id, password, firstname, lastname,  course, status, photo) VALUES ('$voters_id', '$password', '$firstname', '$lastname','$course', '$filename')";
		if($conn->query($sql)){
			$_SESSION['success'] = 'Voter added successfully';
		}

		else{
			$_SESSION['error'] = $conn->error;
		}
		}
	}	
	}

	header('location: voters');