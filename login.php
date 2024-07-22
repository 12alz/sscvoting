<?php
	session_start();
	include 'includes/conn.php';

	if(isset($_POST['login'])){
		$voter = $_POST['voter'];
		$password = $_POST['password'];

		$sql = "SELECT * FROM voters WHERE voters_id = '$voter'";
		$query = $conn->query($sql);

		$row = mysqli_query($conn,$sql);
      $count = mysqli_num_rows($row);

      if($count > 0)
      {
          $rows = mysqli_fetch_object($row);
          if($rows->recstat == '0')
          {
        
			if($query->num_rows < 1){
			$_SESSION['error'] = 'Cannot  find voter with the ID';
			}
			else{
			$row = $query->fetch_assoc();
			if(password_verify($password, $row['password'])){
				$_SESSION['voter'] = $row['id'];
			}
			else{
				$_SESSION['error'] = 'Incorrect username or password';
			}
		}
		
	}
	else{
		$_SESSION['error'] = 'You dont have permission to login';
	}

	}
}
	else{
		$_SESSION['error'] = 'Input voter credentials first';
	}

	header('location: index.php');

?>