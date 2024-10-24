<?php
session_start();
include 'includes/conn.php';

if (isset($_POST['add'])) {
    $firstname = htmlspecialchars($_POST['firstname']);
    $lastname = htmlspecialchars($_POST['lastname']);
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $filename = $_FILES['photo']['name'];
    $validImageExtension = ['jpg', 'jpeg', 'png'];
    $imageExtension = explode('.', $filename);
    $imageExtension = strtolower(end($imageExtension));
    
    if (!in_array($imageExtension, $validImageExtension)) {
        $_SESSION['error'] = 'Invalid Image';
        header('Location: sign_in.php');
    } else {
        if (!empty($filename)) {
            move_uploaded_file($_FILES['photo']['tmp_name'], '../images/' . $filename);   
        }
        
        $course = htmlspecialchars($_POST['course']);
        $status = htmlspecialchars($_POST['status']);
        $voters_id = htmlspecialchars($_POST['voters_id']);
        $checkUser = "SELECT * FROM voters WHERE voters_id ='$voters_id'";
        $result = mysqli_query($conn, $checkUser);
        $count = mysqli_num_rows($result);
        
        if ($count > 0) {
            $_SESSION['error'] = 'ID already exists';
            header('Location: sign_in.php');
        } else {
            $sql = "INSERT INTO voters (voters_id, password, firstname, lastname, course, status, photo) 
                    VALUES ('$voters_id', '$password', '$firstname', '$lastname', '$course', '$status', '$filename')";
            
            if ($conn->query($sql)) {
                $_SESSION['success'] = 'Voter added successfully';
                header('Location: sign_in.php');
            } else {
                $_SESSION['error'] = "Failed to Register";
                header('Location: sign_in.php');
            }
        }
    }
} else {
    $_SESSION['error'] = "Failed to Register";
    header('Location: sign_in.php');
}
