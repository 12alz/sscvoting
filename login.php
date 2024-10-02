<?php
session_start();
include 'includes/conn.php';

if(isset($_POST['login'])){
		$voter = mysql_real_escape_string($_POST['voter']);
		$password = mysql_real_escape_string($_POST['password']);

		$sql = "SELECT * FROM voters WHERE voters_id = '$voter'";
		$query = $conn->query($sql);

		$row = mysqli_query($conn,$sql);
		$count = mysqli_num_rows($row);

	if($count > 0){
		$rows = mysqli_fetch_object($row);
		if($rows->recstat == '0'){
			
				if($query->num_rows < 1){
				$_SESSION['error'] = 'Cannot  find voter with the ID';
				header('Location: sign_in.php');
				}
				else{
				$row = $query->fetch_assoc();
				if(password_verify($password, $row['password'])){
					$_SESSION['voter'] = $row['id'];
					header('Location: home.php');
				}
				else{
					$_SESSION['error'] = 'Incorrect password';
					header('Location: sign_in.php');
				}
			}
		}
		else{
			$_SESSION['error'] = 'You dont have permission to login';
			header('Location: sign_in.php');
		}
	}
}
else{
		$_SESSION['error'] = 'Input voter credentials first';
		header('Location: sign_in.php');
}
header('location: sign_in.php');
?>